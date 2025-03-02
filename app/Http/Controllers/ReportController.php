<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\MenuItem;
use App\Models\Category;
use App\Models\Customer;
use App\Models\InventoryItem;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function generateReport(Request $request)
    {
        $reportType = $request->input('report_type');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        try {
            $data = match($reportType) {
                'sales_by_category' => $this->salesByCategory($startDate, $endDate),
                'employee_performance' => $this->employeePerformance($startDate, $endDate),
                'inventory_movement' => $this->inventoryMovement($startDate, $endDate),
                'customer_analysis' => $this->customerAnalysis($startDate, $endDate),
                default => collect([])
            };

            if ($data->isEmpty()) {
                return response()->json([
                    'error' => true,
                    'message' => 'No se encontraron datos para el período seleccionado'
                ]);
            }

            return response()->json([
                'error' => false,
                'data' => $data
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Error al generar el reporte: ' . $e->getMessage()
            ]);
        }
    }

    private function salesByCategory($startDate, $endDate)
    {
        return MenuItem::select('categories.name')
            ->selectRaw('ROUND(SUM(order_items.quantity * order_items.price), 2) as total_sales')
            ->selectRaw('COUNT(DISTINCT orders.id) as total_orders')
            ->join('categories', 'categories.id', '=', 'menu_items.category_id')
            ->join('order_items', 'menu_items.id', '=', 'order_items.menu_item_id')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->whereBetween('orders.order_date', [$startDate, $endDate])
            ->groupBy('categories.id', 'categories.name')
            ->orderByDesc('total_sales')
            ->get();
    }

    private function employeePerformance($startDate, $endDate)
    {
        return Order::select('users.name')
            ->selectRaw('COUNT(orders.id) as total_orders')
            ->selectRaw('ROUND(SUM(orders.total), 2) as total_sales')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->whereBetween('orders.order_date', [$startDate, $endDate])
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('total_sales')
            ->get();
    }

    private function inventoryMovement($startDate, $endDate)
    {
        return InventoryItem::select(
            'inventory_items.name',
            'inventory_items.quantity as current_stock',
            'inventory_items.reorder_level'
        )
        ->selectRaw('COALESCE(SUM(CASE WHEN inventory_log.change_type = "increment" THEN inventory_log.quantity_change ELSE 0 END), 0) as total_inputs')
        ->selectRaw('COALESCE(SUM(CASE WHEN inventory_log.change_type = "decrement" THEN ABS(inventory_log.quantity_change) ELSE 0 END), 0) as total_outputs')
        ->leftJoin('inventory_log', function($join) use ($startDate, $endDate) {
            $join->on('inventory_items.id', '=', 'inventory_log.inventory_item_id')
                 ->whereBetween('inventory_log.change_date', [$startDate, $endDate]);
        })
        ->groupBy('inventory_items.id', 'inventory_items.name', 'inventory_items.quantity', 'inventory_items.reorder_level')
        ->orderBy('inventory_items.name')
        ->get();
    }

    private function customerAnalysis($startDate, $endDate)
    {
        return Order::select('customers.name')
            ->selectRaw('COUNT(DISTINCT orders.id) as total_orders')
            ->selectRaw('ROUND(SUM(orders.total), 2) as total_spent')
            ->selectRaw('ROUND(AVG(orders.total), 2) as average_order')
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->whereBetween('orders.order_date', [$startDate, $endDate])
            ->groupBy('customers.id', 'customers.name')
            ->orderByDesc('total_spent')
            ->get();
    }

    // ... otros métodos de reporte
}
