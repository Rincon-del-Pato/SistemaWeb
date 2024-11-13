<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use App\Models\InventoryItem;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $daysToShow = 14; // Cambia esto al número de días que quieres mostrar
        $salesTotal = Order::sum('total');
        $ordersToday = Order::whereDate('created_at', now()->toDateString())->count();
        // Modificar cómo se obtiene el inventario a reabastecer
        $inventoryStatus = InventoryItem::where('quantity', '>', 0)
            ->whereColumn('quantity', '<=', 'reorder_level')
            ->count();  // Cambiado de get() a count()

        // Generar las fechas de los últimos X días hasta hoy
        $dates = collect();
        $startDate = Carbon::now()->subDays($daysToShow - 1);

        // Obtener las ventas agrupadas por fecha para los últimos X días
        $salesData = Order::selectRaw('DATE(order_date) as date, SUM(total) as total')
            ->where('order_date', '>=', $startDate)
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get()
            ->pluck('total', 'date');

        // Generar array de fechas y totales en orden correcto
        $salesDates = collect();
        for ($i = 0; $i < $daysToShow; $i++) {
            $currentDate = $startDate->copy()->addDays($i);
            $dateKey = $currentDate->format('Y-m-d');
            $formattedDate = $currentDate->translatedFormat('j M');

            $salesDates->push([
                'date' => $formattedDate,
                'total' => $salesData->get($dateKey, 0)
            ]);
        }

        // Separar las fechas y los totales
        $salesDatesLabels = $salesDates->pluck('date');
        $salesTotals = $salesDates->pluck('total');

        // Modificar la consulta del inventario para mostrar los 10 con menor stock
        $inventory = InventoryItem::select('name', 'quantity', 'reorder_level')
            ->whereNotNull('quantity')
            ->where('quantity', '>=', 0)
            ->orderBy('quantity', 'asc')
            ->take(10)  // Tomar solo los 10 primeros
            ->get();

        $inventoryItems = $inventory->pluck('name');
        $inventoryLevels = $inventory->pluck('quantity');
        $reorderLevels = $inventory->pluck('reorder_level');

        $maxSales = $salesTotals->max();
        $yAxisMax = ceil($maxSales * 1.15);

        $maxInventoryLevel = $inventoryLevels->max();
        $yAxisInventoryMax = ceil($maxInventoryLevel * 1.15);  // Agrega un 10% de margen por encima del máximo
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
            'yAxisInventoryMax'
        ));
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
}
