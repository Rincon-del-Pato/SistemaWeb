<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use App\Models\InventoryItem;
use App\Exports\SalesExport;
use App\Exports\InventoryExport;
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
            'endDate'
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
