<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Table;
use App\Models\Invoice;
use App\Enums\OrderType;
use App\Models\Category;
use App\Models\MenuItem;
use App\Enums\CommandStatus;
use Illuminate\Http\Request;
use App\Enums\PaymentsStatus;
use App\Models\CommandTicket;
use App\Models\InvoiceSeries;
use App\Models\PaymentDetail;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Google\Service\Bigquery\CategoricalValue;
use App\Enums\TableStatus;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Enums\InvoiceType;

class OrderController extends Controller
{
    public function index()
    {
        // Obtener mesas con órdenes locales
        $tables = Table::with(['orders' => function ($query) {
            $query->where('payment_status', PaymentsStatus::Pendiente->value)
                ->with(['orderItems.menuItem', 'user.employee'])
                ->latest();
        }])->get();

        // Obtener órdenes para llevar agrupadas por estado
        $paraLlevarOrders = [
            'Pendiente' => Order::with(['orderItems.menuItem', 'user.employee', 'customer', 'commandTickets'])
                ->where('order_type', OrderType::ParaLlevar->value)
                ->whereHas('commandTickets', function ($query) {
                    $query->where('status', CommandStatus::Pendiente->value);
                })
                ->latest()
                ->get(),

            'Preparando' => Order::with(['orderItems.menuItem', 'user.employee', 'customer', 'commandTickets'])
                ->where('order_type', OrderType::ParaLlevar->value)
                ->whereHas('commandTickets', function ($query) {
                    $query->where('status', CommandStatus::En_Progreso->value);
                })
                ->latest()
                ->get(),

            'Completado' => Order::with(['orderItems.menuItem', 'user.employee', 'customer', 'commandTickets'])
                ->where('order_type', OrderType::ParaLlevar->value)
                ->whereHas('commandTickets', function ($query) {
                    $query->where('status', CommandStatus::Completado->value);
                })
                ->latest()
                ->get()
        ];

        // Obtener órdenes delivery agrupadas por estado
        $deliveryOrders = [
            'Pendiente' => Order::with(['orderItems.menuItem', 'user.employee', 'customer', 'commandTickets'])
                ->where('order_type', OrderType::Delivery->value)
                ->whereHas('commandTickets', function ($query) {
                    $query->where('status', CommandStatus::Pendiente->value);
                })
                ->latest()
                ->get(),

            'Preparando' => Order::with(['orderItems.menuItem', 'user.employee', 'customer', 'commandTickets'])
                ->where('order_type', OrderType::Delivery->value)
                ->whereHas('commandTickets', function ($query) {
                    $query->where('status', CommandStatus::En_Progreso->value);
                })
                ->latest()
                ->get(),

            'Enviando' => Order::with(['orderItems.menuItem', 'user.employee', 'customer', 'commandTickets'])
                ->where('order_type', OrderType::Delivery->value)
                ->whereHas('commandTickets', function ($query) {
                    $query->where('status', CommandStatus::Enviando->value);
                })
                ->latest()
                ->get(),

            'Completado' => Order::with(['orderItems.menuItem', 'user.employee', 'customer', 'commandTickets'])
                ->where('order_type', OrderType::Delivery->value)
                ->whereHas('commandTickets', function ($query) {
                    $query->where('status', CommandStatus::Completado->value);
                })
                ->latest()
                ->get()
        ];

        // Contar mesas disponibles y ocupadas
        $availableCount = $tables->where('status.value', 'Disponible')->count();
        $occupiedCount = $tables->where('status.value', 'Ocupado')->count();

        return view('orders.index', compact(
            'tables',
            'availableCount',
            'occupiedCount',
            'paraLlevarOrders',
            'deliveryOrders'
        ));
    }

    public function create(Request $request)
    {
        $orderType = $request->type ?? OrderType::Local->value;
        $table = null;
        $customerCount = 1;

        if ($orderType === OrderType::Local->value) {
            $table = Table::findOrFail($request->table_id);
            $customerCount = $request->customer_count;
        }

        $categories = Category::all();
        $menus = MenuItem::with(['sizes' => function ($query) {
            $query->orderBy('price', 'asc');
        }])
            ->when($request->category, function ($query, $category) {
                return $query->where('category_id', $category);
            })
            ->where('available', true)
            ->get();

        return view('orders.create', compact('table', 'customerCount', 'categories', 'menus', 'orderType'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Modificar la validación para no requerir customer_name en Para Llevar
            $validatedData = $request->validate([
                'order_type' => 'required|in:Local,ParaLlevar,Delivery',
                'customer_name' => 'required_if:order_type,Delivery',
                'customer_phone' => 'required_if:order_type,Delivery',
                'delivery_address' => 'required_if:order_type,Delivery',
                'items' => 'required|array',
            ]);

            // Crear la orden principal
            $orderData = [
                'user_id' => auth()->id(),
                'order_type' => $request->order_type,
                'payment_status' => PaymentsStatus::Pendiente->value,
                'total' => 0,
                'order_date' => now(),
                'delivery_address' => $request->delivery_address,
                'num_guests' => $request->customer_count ?? 1,
            ];

            // Agregar table_id solo si es orden Local
            if ($request->order_type === OrderType::Local->value) {
                $orderData['table_id'] = $request->table_id;
                if ($request->table_id) {
                    Table::where('id', $request->table_id)
                        ->update(['status' => TableStatus::Ocupado->value]);
                }
            }

            $order = Order::create($orderData);

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

            DB::commit();
            return response()->json([
                'success' => true,
                'orderId' => $order->id
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function edit(Order $order)
    {
        $order->load(['orderItems.menuItem.sizes', 'table', 'user', 'commandTicket.items']);

        // Modificar para incluir el estado de la comanda en cada item
        foreach ($order->orderItems as $item) {
            $commandItem = $order->commandTicket?->items->where('menu_item_id', $item->menu_item_id)->first();
            // Verificar si el item está en la comanda
            if ($commandItem) {
                $item->commandStatus = $order->commandTicket->status;
                $item->isEditable = $order->commandTicket->status === 'Pendiente';
            } else {
                // Si el item no está en la comanda, es editable
                $item->commandStatus = null;
                $item->isEditable = true;
            }
        }

        $categories = Category::all();
        $menus = MenuItem::with(['sizes' => function ($query) {
            $query->orderBy('price', 'asc');
        }])
            ->where('available', true)
            ->get();

        return view('orders.edit', compact('order', 'categories', 'menus'));
    }

    public function update(Request $request, Order $order)
    {
        try {
            DB::beginTransaction();

            // Validación de la solicitud
            $request->validate([
                'items' => 'required|array',
                'items.*.menu_item_id' => 'required|exists:menu_items,id',
                'items.*.quantity' => 'required|integer|min:1',
                'items.*.price' => 'required|numeric|min:0',
                'items.*.special_requests' => 'nullable|string',
                'items.*.is_new' => 'required|boolean'
            ]);

            $newItems = [];
            $existingCommandTicket = $order->commandTicket;
            $existingItems = $order->orderItems->pluck('menu_item_id')->toArray();

            // Procesar cada item del request
            foreach ($request->items as $item) {
                if ($item['is_new']) {
                    // Guardar nuevos ítems para la nueva comanda

                    $newItems[] = $item;

                    // Crear el nuevo ítem en la orden
                    $order->orderItems()->create([
                        'menu_item_id' => $item['menu_item_id'],
                        'quantity' => $item['quantity'],
                        'price' => $item['price']
                    ]);
                } else {
                    // Actualizar ítems existentes si la comanda está pendiente
                    if ($existingCommandTicket && $existingCommandTicket->status === CommandStatus::Pendiente->value) {
                        $order->orderItems()
                            ->where('menu_item_id', $item['menu_item_id'])
                            ->update([
                                'quantity' => $item['quantity']
                            ]);

                        $existingCommandTicket->items()
                            ->where('menu_item_id', $item['menu_item_id'])
                            ->update([
                                'quantity' => $item['quantity'],
                                'special_requests' => $item['special_requests'] ?? null
                            ]);
                    }
                }
            }

            // Crear nueva comanda solo para los nuevos ítems
            if (!empty($newItems)) {
                $newCommandTicket = CommandTicket::create([
                    'order_id' => $order->id,
                    'status' => CommandStatus::Pendiente->value
                ]);

                // Crear ítems en la nueva comanda
                foreach ($newItems as $item) {
                    $newCommandTicket->items()->create([
                        'menu_item_id' => $item['menu_item_id'],
                        'quantity' => $item['quantity'],
                        'special_requests' => $item['special_requests'] ?? null
                    ]);
                }

                // Registrar el log de la nueva comanda
                $newCommandTicket->logs()->create([
                    'command_ticket_id' => $newCommandTicket->id,
                    'previous_status' => CommandStatus::Pendiente->value,
                    'new_status' => CommandStatus::Pendiente->value,
                    'change_date' => now(),
                    'notes' => 'Nueva comanda creada para ítems adicionales'
                ]);
            }

            // Actualizar el total de la orden
            $total = $order->orderItems()->sum(DB::raw('quantity * price'));
            $order->update(['total' => $total]);

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Orden actualizada correctamente'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error en actualización de orden: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
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

    public function preBill(Order $order)
    {
        $order->load(['orderItems.menuItem', 'table', 'user']);

        $pdf = PDF::loadView('orders.pre-bill', compact('order'));

        // Configurar el tamaño del papel para tickets
        $pdf->setPaper([0, 0, 226.77, 841.89], 'portrait'); // 80mm (ancho) x 297mm (alto)

        return $pdf->stream('pre-cuenta-' . $order->id . '.pdf');
    }

    public function cancel(Order $order)
    {
        try {
            DB::beginTransaction();

            // Cargar todas las comandas asociadas a la orden
            $order->load('commandTickets');

            // Cancelar todas las comandas, independientemente de su estado
            foreach ($order->commandTickets as $commandTicket) {
                $oldStatus = $commandTicket->status;

                // Actualizar estado de la comanda
                $commandTicket->update([
                    'status' => CommandStatus::Cancelado->value
                ]);

                // Registrar el cambio en el log
                $commandTicket->logs()->create([
                    'command_ticket_id' => $commandTicket->id,
                    'previous_status' => $oldStatus,
                    'new_status' => CommandStatus::Cancelado->value,
                    'change_date' => now(),
                    'notes' => 'Comanda cancelada por anulación de pedido'
                ]);
            }

            // Liberar mesa
            $order->table->update(['status' => TableStatus::Disponible]);

            // Marcar orden como anulada
            $order->update([
                'payment_status' => PaymentsStatus::Anulado->value
            ]);

            DB::commit();
            return redirect()->route('orders.index')
                ->with('success', 'Pedido y comandas cancelados correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al cancelar pedido: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error al cancelar el pedido: ' . $e->getMessage());
        }
    }

    public function changeTable(Request $request)
    {
        try {
            DB::beginTransaction();

            $currentTable = Table::findOrFail($request->currentTableId);
            $newTable = Table::findOrFail($request->newTableId);

            if ($newTable->status !== TableStatus::Disponible) {
                throw new \Exception('La mesa seleccionada no está disponible');
            }

            // Actualizar la orden con la nueva mesa
            $order = Order::where('table_id', $currentTable->id)
                ->where('payment_status', PaymentsStatus::Pendiente)
                ->firstOrFail();

            $order->update(['table_id' => $newTable->id]);

            // Actualizar estados de las mesas
            $currentTable->update(['status' => TableStatus::Disponible]);

            $newTable->update(['status' => TableStatus::Ocupado]);

            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function payment(Order $order)
    {
        $order->load(['orderItems.menuItem', 'user']);
        
        // Cargar la tabla solo si es una orden Local
        if ($order->order_type === OrderType::Local->value) {
            $order->load('table');
        }
        
        $paymentMethods = PaymentMethod::all();
        $defaultCustomer = [
            'name' => 'CLIENTE GENERAL',
            'document_type' => 'DNI',
            'document_number' => '00000000'
        ];
        
        return view('orders.payment', compact('order', 'paymentMethods', 'defaultCustomer'));
    }

    public function processPayment(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $order = Order::findOrFail($id);

            // Validar datos requeridos
            $validated = $request->validate([
                'payment_method_id' => 'required',
                'customer_document_number' => 'required',
                'customer_name' => 'required',
                'customer_document_type' => 'required|in:DNI,RUC',
            ]);

            // Determinar tipo de comprobante automáticamente
            $invoiceType = $validated['customer_document_type'] === 'RUC' ?
                InvoiceType::Factura :
                InvoiceType::Boleta;

            // Obtener o crear la serie según el tipo de comprobante
            $seriesPrefix = $invoiceType === InvoiceType::Boleta ? 'B001' : 'F001';

            $series = InvoiceSeries::firstOrCreate(
                ['series' => $seriesPrefix],
                [
                    'document_type' => $invoiceType->value,
                    'current_number' => 0,
                    'is_active' => true
                ]
            );

            $currentNumber = $series->current_number + 1;
            $series->update(['current_number' => $currentNumber]);

            // Crear la factura
            $invoice = Invoice::create([
                'order_id' => $order->id,
                'invoice_type' => $invoiceType->value,
                'series' => $series->series,
                'number' => $currentNumber,
                'total' => $order->total,
                'tax' => $order->total * 0.18,
                'customer_name' => $validated['customer_name'],
                'customer_document_type' => $validated['customer_document_type'],
                'customer_document_number' => $validated['customer_document_number'],
                'customer_address' => $request->customer_address,
                'issue_date' => now()
            ]);

            // Crear los items de la factura
            foreach ($order->orderItems as $item) {
                $invoice->items()->create([
                    'description' => $item->menuItem->name,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->price,
                    'total_price' => $item->quantity * $item->price
                ]);
            }

            // Registrar el pago
            PaymentDetail::create([
                'order_id' => $order->id,
                'payment_method_id' => $validated['payment_method_id'],
                'amount' => $order->total,
                'payment_date' => now()
            ]);

            // Actualizar el estado de la orden
            $order->update(['payment_status' => PaymentsStatus::Pagado->value]);
            
            // Actualizar estado de mesa solo si es orden Local
            if ($order->order_type === OrderType::Local->value && $order->table) {
                $order->table->update(['status' => TableStatus::Disponible->value]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pago procesado correctamente',
                'invoice_url' => route('orders.invoice', $order->id)
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al procesar pago: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al procesar el pago: ' . $e->getMessage()
            ], 500);
        }
    }

    public function invoice(Order $order)
    {
        $order->load(['orderItems.menuItem', 'table', 'user', 'invoice.items']);

        $pdf = PDF::loadView('orders.invoice', compact('order'));

        // Configurar el tamaño del papel para tickets
        $pdf->setPaper([0, 0, 226.77, 439.37], 'portrait'); // 80mm x 155mm

        return $pdf->stream('comprobante-' . $order->invoice->series . '-' . $order->invoice->number . '.pdf');
    }

    public function getDetails(Order $order)
    {
        $order->load(['orderItems.menuItem', 'user', 'customer']);
        return response()->json($order);
    }
}
