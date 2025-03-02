<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use App\Models\InventoryItem;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function getDashboardData(Request $request)
    {
        try {
            // Obtener fechas del request o usar valores por defecto
            $startDate = $request->input('start_date') ? Carbon::parse($request->start_date) : Carbon::now()->subDays(13);
            $endDate = $request->input('end_date') ? Carbon::parse($request->end_date) : Carbon::now();

            // Datos básicos
            $salesTotal = Order::whereBetween('order_date', [$startDate, $endDate])->sum('total');
            $ordersToday = Order::whereDate('created_at', now()->toDateString())->count();
            $totalOrders = Order::whereBetween('order_date', [$startDate, $endDate])->count();

            // Ventas diarias
            $salesData = Order::selectRaw('DATE(order_date) as date, SUM(total) as total')
                ->whereBetween('order_date', [$startDate, $endDate])
                ->groupBy('date')
                ->orderBy('date', 'ASC')
                ->get();

            // Inventario bajo
            $lowInventory = InventoryItem::select('name', 'quantity', 'reorder_level')
                ->whereColumn('quantity', '<=', 'reorder_level')
                ->where('quantity', '>', 0)
                ->get()
                ->map(function ($item) {
                    return [
                        'name' => $item->name,
                        'quantity' => (int)$item->quantity,
                        'reorder_level' => (int)$item->reorder_level,
                        'status' => 'Requiere reabastecimiento'
                    ];
                });

            // Top productos
            $topProducts = MenuItem::select('menu_items.name')
                ->selectRaw('SUM(order_items.quantity) as total_quantity')
                ->join('order_items', 'menu_items.id', '=', 'order_items.menu_item_id')
                ->join('orders', 'orders.id', '=', 'order_items.order_id')
                ->whereBetween('orders.order_date', [$startDate, $endDate])
                ->groupBy('menu_items.id', 'menu_items.name')
                ->orderByDesc('total_quantity')
                ->take(5)
                ->get();

            // Rendimiento empleados
            $employeePerformance = Order::select('users.name')
                ->selectRaw('COUNT(orders.id) as total_orders')
                ->selectRaw('SUM(orders.total) as total_sales')
                ->join('users', 'users.id', '=', 'orders.user_id')
                ->whereBetween('orders.order_date', [$startDate, $endDate])
                ->groupBy('users.id', 'users.name')
                ->orderByDesc('total_sales')
                ->take(5)
                ->get();

            // Tipos de órdenes
            $orderTypes = Order::whereBetween('order_date', [$startDate, $endDate])
                ->selectRaw('order_type, COUNT(*) as total')
                ->groupBy('order_type')
                ->get();

            // Categorías más vendidas
            $topCategories = MenuItem::select('categories.name')
                ->selectRaw('CAST(COALESCE(SUM(order_items.quantity), 0) AS SIGNED) as total_quantity')
                ->join('categories', 'categories.id', '=', 'menu_items.category_id')
                ->leftJoin('order_items', 'menu_items.id', '=', 'order_items.menu_item_id')
                ->leftJoin('orders', 'orders.id', '=', 'order_items.order_id')
                ->whereBetween('orders.order_date', [$startDate, $endDate])
                ->groupBy('categories.id', 'categories.name')
                ->havingRaw('total_quantity > 0')
                ->orderByDesc('total_quantity')
                ->take(5)
                ->get();

            return response()->json([
                'status' => 'success',
                'data' => [
                    'resumen' => [
                        'ventas_totales' => number_format($salesTotal, 2),
                        'pedidos_hoy' => $ordersToday,
                        'total_pedidos' => $totalOrders
                    ],
                    'ventas_diarias' => $salesData,
                    'inventario_bajo' => $lowInventory,
                    'top_productos' => $topProducts,
                    'rendimiento_empleados' => $employeePerformance,
                    'tipos_ordenes' => $orderTypes,
                    'top_categorias' => $topCategories
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Dashboard API Error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Error al cargar los datos del dashboard',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
