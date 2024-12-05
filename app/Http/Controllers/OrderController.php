<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Table;
use App\Enums\OrderType;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use App\Enums\PaymentsStatus;
use Illuminate\Support\Facades\DB;
use Google\Service\Bigquery\CategoricalValue;
use App\Enums\TableStatus;  // Agregar este import

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
        $menus = MenuItem::with(['sizes' => function($query) {
            $query->orderBy('price', 'asc');
        }])
        ->when($request->category, function($query, $category) {
            return $query->where('category_id', $category);
        })
        ->where('available', true)
        ->get();

        return view('orders.create', compact('table', 'customerCount', 'categories', 'menus'));
    }

    public function store(Request $request)
    {
        // // Validar los datos recibidos
        // $validated = $request->validate([
        //     'table_id' => 'required|exists:tables,id',
        //     'customer_count' => 'required|integer|min:1',
        //     'customer_id' => 'nullable|exists:customers,id',
        //     'items' => 'required|array|min:1',
        //     'items.*.menu_item_id' => 'required|exists:menu_items,id',
        //     'items.*.quantity' => 'required|integer|min:1',
        //     'items.*.price' => 'required|numeric|min:0',
        // ]);

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

            // Procesar los items
            $total = 0;
            foreach ($request->items as $item) {
                $order->orderItems()->create([
                    'menu_item_id' => $item['menu_item_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);
                $total += $item['price'] * $item['quantity'];
            }

            // Actualizar el total de la orden
            $order->update(['total' => $total]);

            // Actualizar estado de la mesa
            Table::where('id', $request->table_id)
                ->update(['status' => TableStatus::Ocupado->value]);

            DB::commit();
            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
