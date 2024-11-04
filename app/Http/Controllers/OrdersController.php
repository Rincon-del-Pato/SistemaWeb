<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Tables;
use App\Models\Products;
use App\Models\Employees;
use App\Models\Categories;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Enums\TableStatusTab;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tables = Tables::all();
        return view('orders.index', compact('tables'));
    }

    public function create(Request $request, $tableId)
    {
        $request->validate([
            'people_count' => 'required|numeric|min:1',
        ]);

        $peopleCount = $request->query('people_count');
        $table = Tables::findOrFail($tableId);

        // Una sola consulta para obtener los productos
        // $products = Products::with(['category', 'sizes' => function ($query) {
        //     $query->where('status', 'Disponible');
        // }])->get()
        //     ->groupBy('category_id');

        $products = Products::with('sizes')->get()->groupBy('category_id');

        $employees = Employees::where('user_id', Auth::id())->first();
        $categories = Categories::all();

        return view('orders.create', compact('peopleCount', 'table', 'tableId', 'products', 'employees', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $tableId)
    {
        //return $request;

        // Validación
        // $request->validate([
        //     'table_id' => 'required|exists:tables,id',
        //     'employee_id' => 'required|exists:employees,id',
        //     'total_amount' => 'required|numeric|min:0',
        //     'items' => 'required|array|min:1',
        //     'items.*.product_size_id' => 'required|exists:product_size,id',
        //     'items.*.quantity' => 'required|integer|min:1',
        //     'items.*.unit_price' => 'required|numeric|min:0',
        //     'items.*.subtotal' => 'required|numeric|min:0',
        // ]);

        try {
            DB::beginTransaction();

            // Crear orden principal
            $order = Orders::create([
                'table_id' => $tableId,
                'employee_id' => $request->employee_id,
                'total_amount' => $request->total_amount,
                'notes' => $request->notes ?? null
            ]);

            // Crear items de la orden
            foreach ($request->items as $item) {
                $order->orderItems()->create([
                    'product_size_id' => $item['product_size_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'subtotal' => $item['subtotal'],
                    'special_instructions' => $item['special_instructions'] ?? null
                ]);
            }

            // Actualizar estado de la mesa
            $table = Tables::findOrFail($tableId);
            $table->status = TableStatusTab::Ocupado->value;
            $table->save();

            DB::commit();
            return redirect()->route('order.index')
                ->with('success', 'Orden creada exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al crear la orden: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
