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
use Google\Service\Bigquery\CategoricalValue;
use App\Enums\TableStatus;  // Agregar este import

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['customer', 'table', 'orderItems.menuItem'])->latest()->get();

        // Obtener conteos de mesas
        $availableCount = Table::where('status', TableStatus::Disponible->value)->count();
        $occupiedCount = Table::where('status', TableStatus::Ocupado->value)->count();

        $tables = Table::with(['orders' => function($query) {
            $query->latest();
        }])->get();

        // Preparar los datos de los empleados para cada mesa
        $tables = $tables->map(function($table) {
            if ($table->status->value === 'Ocupado') {
                $order = $table->orders->first();
                $table->setAttribute('num_guests', $order ? $order->num_guests : 0);
                $employee = $order ? Employee::where('user_id', $order->user_id)->first() : null;
                if ($employee) {
                    $firstName = explode(' ', $employee->user->name)[0]; // Toma solo el primer nombre
                    $firstLastName = explode(' ', $employee->lastname)[0]; // Toma solo el primer apellido
                    $table->setAttribute('waiterName', $firstName . ' ' . $firstLastName);
                } else {
                    $table->setAttribute('waiterName', 'No asignado');
                }
            }
            return $table;
        });

        return view('orders.index', compact('orders', 'tables', 'availableCount', 'occupiedCount'));
    }

    public function create(Request $request)
    {
        $table = Table::findOrFail($request->table_id);
        $customerCount = $request->customer_count;
        $categories = Category::all();
        $menus = MenuItem::when($request->category, function($query, $category) {
            return $query->where('category_id', $category);
        })->where('available', true)->get();

        return view('orders.create', compact('table', 'customerCount', 'categories', 'menus'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'table_id' => 'required|exists:tables,id',
            'customer_count' => 'required|integer|min:1',
            'items' => 'required|array',
            'items.*.menu_item_id' => 'required|exists:menu_items,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        // Obtener el employee_id del usuario autenticado
        $employee = auth()->user()->employee;

        // Crear el pedido
        $order = Order::create([
            'table_id' => $validated['table_id'],
            'num_guests' => $validated['customer_count'], // Cambiado de customer_count a num_guests
            'user_id' => auth()->id(),
            'order_type' => OrderType::Local->value, // Corregido: agregando ->value
            'payment_status' => PaymentsStatus::Pendiente->value, // Corregido: agregando ->value
            'total' => 0
        ]);

        // Crear el registro en employee_sales
        $order->employeeSales()->create([
            'employee_id' => $employee->id,
            'sale_amount' => 0, // Se actualizará después
        ]);

        // Actualizar estado de la mesa
        Table::where('id', $validated['table_id'])
            ->update(['status' => TableStatus::Ocupado->value]);

        $total = 0;
        foreach ($validated['items'] as $item) {
            $menuItem = MenuItem::find($item['menu_item_id']);
            $order->orderItems()->create([
                'menu_item_id' => $item['menu_item_id'],
                'quantity' => $item['quantity'],
                'price' => $menuItem->price
            ]);
            $total += $menuItem->price * $item['quantity'];
        }

        $order->update(['total' => $total]);

        return redirect()->route('orders.index')->with('success', 'Orden creada exitosamente');
    }
}
