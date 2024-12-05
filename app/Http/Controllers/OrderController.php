<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Table;
use App\Enums\OrderType;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\MenuItem;
use App\Models\CommandTicket;
use Illuminate\Http\Request;
use App\Enums\PaymentsStatus;
use Illuminate\Support\Facades\DB;
use Google\Service\Bigquery\CategoricalValue;
use App\Enums\TableStatus;  // Agregar este import
use App\Enums\CommandStatus;

class OrderController extends Controller
{
    public function index()
    {
        $tables = Table::with(['orders.orderItems.menuItem', 'orders.user.employee'])
            ->get();

        return view('orders.index', [
            'tables' => $tables,
            'availableCount' => $tables->where('status.value', 'Disponible')->count(),
            'occupiedCount' => $tables->where('status.value', 'Ocupado')->count(),
        ]);
    }

    public function create(Request $request)
    {
        $table = Table::findOrFail($request->table_id);
        $customerCount = $request->customer_count;
        $categories = Category::all();
        $menus = MenuItem::with(['sizes' => function ($query) {
            $query->orderBy('price', 'asc');
        }])
            ->when($request->category, function ($query, $category) {
                return $query->where('category_id', $category);
            })
            ->where('available', true)
            ->get();

        return view('orders.create', compact('table', 'customerCount', 'categories', 'menus'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Crear la orden principal
            $order = Order::create([
                'table_id' => $request->table_id,
                'customer_id' => $request->customer_id, // Agregamos el customer_id
                'num_guests' => $request->customer_count,
                'user_id' => auth()->id(),
                'order_type' => OrderType::Local->value,
                'payment_status' => PaymentsStatus::Pendiente->value,
                'total' => 0,
                'order_date' => now()
            ]);

            // Procesar los items de la orden
            $total = 0;
            foreach ($request->items as $item) {
                $orderItem = $order->orderItems()->create([
                    'menu_item_id' => $item['menu_item_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);
                $total += $item['price'] * $item['quantity'];
            }

            // Crear la comanda - Corregido
            $commandTicket = CommandTicket::create([
                'order_id' => $order->id,
                'status' => CommandStatus::Pendiente->value
            ]);

            // Crear los items de la comanda - Corregido
            foreach ($request->items as $item) {
                $commandTicket->items()->create([
                    'command_ticket_id' => $commandTicket->id,
                    'menu_item_id' => $item['menu_item_id'],
                    'quantity' => $item['quantity'],
                    'special_requests' => $item['special_requests'] ?? null
                ]);
            }

            // Registrar el log inicial de la comanda
            $commandTicket->logs()->create([
                'command_ticket_id' => $commandTicket->id,
                'previous_status' => CommandStatus::Pendiente->value, // Cambiado de null a un valor inicial
                'new_status' => CommandStatus::Pendiente->value,
                'change_date' => now(),
                'notes' => 'Comanda creada'
            ]);

            // Actualizar el total de la orden y mesa
            $order->update(['total' => $total]);
            Table::where('id', $request->table_id)
                ->update(['status' => TableStatus::Ocupado->value]);

            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function edit(Order $order)
    {
        $table = $order->table;
        $categories = Category::all();
        $menus = MenuItem::with(['sizes' => function($query) {
            $query->orderBy('price', 'asc');
        }, 'category'])->where('available', true)->get();

        // Cargar explícitamente las relaciones necesarias
        $order->load(['orderItems.menuItem.sizes', 'commandTicket.items']);
        
        $commandTicket = $order->commandTicket;
        $commandStatus = $commandTicket ? $commandTicket->status : null;

        $orderItems = $order->orderItems->map(function ($item) use ($commandStatus) {
            $menuItem = $item->menuItem;
            if (!$menuItem) {
                return null;
            }

            // Buscar el tamaño correspondiente al precio
            $size = $menuItem->sizes->first(function($size) use ($item) {
                return abs($size->pivot->price - $item->price) < 0.01;
            });

            return [
                'menuId' => $item->menu_item_id,
                'name' => $menuItem->name,
                'price' => $item->price,
                'sizeName' => $size ? $size->size_name : 'Normal',
                'quantity' => $item->quantity,
                'subtotal' => $item->price * $item->quantity,
                'special_requests' => $item->special_requests,
                'isCompleted' => $commandStatus === CommandStatus::Completado->value,
                'command_ticket_item_id' => $item->commandTicketItem?->id
            ];
        })->filter();

        return view('orders.create', [
            'table' => $table,
            'categories' => $categories,
            'menus' => $menus,
            'customerCount' => $order->num_guests,
            'existingOrder' => $order,
            'existingOrderItems' => $orderItems,
            'commandStatus' => $commandStatus
        ]);
    }

    public function update(Request $request, Order $order)
    {
        try {
            DB::beginTransaction();

            // Validar la solicitud
            $request->validate([
                'items' => 'required|array',
                'items.*.menu_item_id' => 'required|exists:menu_items,id',
                'items.*.quantity' => 'required|integer|min:1',
                'items.*.price' => 'required|numeric|min:0',
                'items.*.special_requests' => 'nullable|string'
            ]);

            $commandTicket = $order->commandTicket;
            $existingItems = $order->orderItems->pluck('menu_item_id')->toArray();

            foreach ($request->items as $item) {
                // Verificar si el item ya existe
                $isExistingItem = in_array($item['menu_item_id'], $existingItems);
                
                // Si el item existe y está completado, saltarlo
                if ($isExistingItem && $commandTicket && 
                    $commandTicket->status === CommandStatus::Completado->value) {
                    continue;
                }

                // Si es un nuevo item, crear registros
                if (!$isExistingItem) {
                    // Crear order item
                    $orderItem = $order->orderItems()->create([
                        'menu_item_id' => $item['menu_item_id'],
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                        'special_requests' => $item['special_requests'] ?? null
                    ]);

                    // Crear command ticket item
                    if ($commandTicket) {
                        $commandTicket->items()->create([
                            'menu_item_id' => $item['menu_item_id'],
                            'quantity' => $item['quantity'],
                            'special_requests' => $item['special_requests'] ?? null,
                            'status' => CommandStatus::Pendiente->value
                        ]);
                    }
                }
            }

            // Actualizar el total de la orden
            $order->total = $order->orderItems->sum(function ($item) {
                return $item->quantity * $item->price;
            });
            $order->save();

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Orden actualizada correctamente'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function updateCommandStatus(Request $request, CommandTicket $commandTicket)
    {
        try {
            DB::beginTransaction();

            $oldStatus = $commandTicket->status;
            $newStatus = CommandStatus::from($request->status);

            // Actualizar estado de la comanda
            $commandTicket->update([
                'status' => $newStatus
            ]);

            // Registrar el cambio en el log
            $commandTicket->logs()->create([
                'command_ticket_id' => $commandTicket->id,
                'previous_status' => $oldStatus,
                'new_status' => $newStatus,
                'change_date' => now(),
                'notes' => $request->notes ?? 'Actualización de estado'
            ]);

            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
