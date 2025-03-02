<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\MenuItem;
use App\Exports\SalesExport;
use Illuminate\Http\Request;
use App\Models\InventoryItem;
use App\Exports\InventoryExport;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public function index()
    {
        $startDate = Carbon::now()->subDays(13);
        $endDate = Carbon::now();
        return $this->getDashboardData($startDate, $endDate);
    }

    public function filter(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date'
        ]);

        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        return $this->getDashboardData($startDate, $endDate);
    }

    private function getDashboardData($startDate, $endDate)
    {
        $salesTotal = Order::whereBetween('order_date', [$startDate, $endDate])->sum('total');
        $ordersToday = Order::whereDate('created_at', now()->toDateString())->count();
        $inventoryStatus = InventoryItem::where('quantity', '>', 0)
            ->whereColumn('quantity', '<=', 'reorder_level')
            ->count();

        $salesData = Order::selectRaw('DATE(order_date) as date, SUM(total) as total')
            ->whereBetween('order_date', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get()
            ->pluck('total', 'date');

        $dates = collect();
        $currentDate = $startDate->copy();
        while ($currentDate <= $endDate) {
            $dateKey = $currentDate->format('Y-m-d');
            $formattedDate = $currentDate->translatedFormat('j M');

            $dates->push([
                'date' => $formattedDate,
                'total' => $salesData->get($dateKey, 0)
            ]);

            $currentDate->addDay();
        }

        $salesDatesLabels = $dates->pluck('date');
        $salesTotals = $dates->pluck('total');

        $inventory = InventoryItem::select('name', 'quantity', 'reorder_level')
            ->whereNotNull('quantity')
            ->where('quantity', '>=', 0)
            ->orderBy('quantity', 'asc')
            ->take(10)
            ->get();

        $inventoryItems = $inventory->pluck('name');
        $inventoryLevels = $inventory->pluck('quantity');
        $reorderLevels = $inventory->pluck('reorder_level');

        $yAxisMax = ceil($salesTotals->max() * 1.15);
        $yAxisInventoryMax = ceil($inventoryLevels->max() * 1.15);

        // Obtener el producto más vendido
        $topSellingProduct = MenuItem::select('menu_items.name')
            ->join('order_items', 'menu_items.id', '=', 'order_items.menu_item_id')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->whereBetween('orders.order_date', [$startDate, $endDate])
            ->groupBy('menu_items.id', 'menu_items.name')
            ->orderByRaw('SUM(order_items.quantity) DESC')
            ->first()
            ->name ?? 'N/A';

        // Top 5 productos más vendidos
        $topProducts = MenuItem::select('menu_items.name')
            ->selectRaw('SUM(order_items.quantity) as total_quantity')
            ->join('order_items', 'menu_items.id', '=', 'order_items.menu_item_id')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->whereBetween('orders.order_date', [$startDate, $endDate])
            ->groupBy('menu_items.id', 'menu_items.name')
            ->orderByRaw('total_quantity DESC')
            ->take(5)
            ->get();

        $topProductsNames = $topProducts->pluck('name');
        $topProductsQuantities = $topProducts->pluck('total_quantity');

        // Rendimiento de empleados
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
            ->where(function($query) use ($startDate, $endDate) {
                $query->whereBetween('orders.order_date', [$startDate, $endDate])
                      ->orWhereNull('orders.order_date');
            })
            ->groupBy('categories.id', 'categories.name')
            ->havingRaw('CAST(COALESCE(SUM(order_items.quantity), 0) AS SIGNED) > 0')
            ->orderByDesc('total_quantity')
            ->take(5)
            ->get();

        // Debug para verificar los datos
        Log::info('Datos de categorías:', [
            'nombres' => $topCategories->pluck('name'),
            'cantidades' => $topCategories->pluck('total_quantity'),
            'datos_completos' => $topCategories->toArray()
        ]);

        // Agregar un log para verificar los datos
        Log::info('Categorías más vendidas:', $topCategories->toArray());

        // Añadir total de órdenes en el período
        $totalOrders = Order::whereBetween('order_date', [$startDate, $endDate])->count();

        return view('dashboard', compact(
            'salesTotal',
            'ordersToday',
            'inventoryStatus',
            'salesDatesLabels',
            'salesTotals',
            'inventoryItems',
            'inventoryLevels',
            'reorderLevels',
            'yAxisMax',
            'yAxisInventoryMax',
            'startDate',
            'endDate',
            'topSellingProduct',
            'topProductsNames',
            'topProductsQuantities',
            'employeePerformance',
            'orderTypes',
            'topCategories',
            'totalOrders'
        ));
    }

    public function exportSales($startDate = null, $endDate = null)
    {
        $startDate = $startDate ? Carbon::parse($startDate) : Carbon::now()->subDays(13);
        $endDate = $endDate ? Carbon::parse($endDate) : Carbon::now();

        return Excel::download(new SalesExport($startDate, $endDate), 'ventas.xlsx');
    }

    public function exportInventory()
    {
        return Excel::download(new InventoryExport, 'inventario.xlsx');
    }

    public function getSalesData()
    {
        $salesData = Order::selectRaw('DATE(created_at) as date, SUM(total) as total')
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        return response()->json($salesData);
    }

    public function getInventoryStatus()
    {
        // Lógica para obtener el estado del inventario
    }

    public function getEmployeePerformance()
    {
        // Lógica para obtener el rendimiento de empleados
    }

    //composer require maatwebsite/excel
    //php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider"
}
