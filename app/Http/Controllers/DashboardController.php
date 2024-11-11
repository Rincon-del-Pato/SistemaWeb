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
        $inventoryStatus = InventoryItem::whereColumn('quantity', '<=', 'reorder_level')->get();

        // Generar las fechas de los últimos X días hasta hoy
        $dates = collect();
        for ($i = $daysToShow - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            // Formateo en español (día y mes en formato abreviado)
            $dates->push($date->translatedFormat('j M'));
        }

        // Obtener las ventas agrupadas por fecha para los últimos X días
        $salesData = Order::selectRaw('DATE(order_date) as date, SUM(total) as total')
            ->where('order_date', '>=', Carbon::now()->subDays($daysToShow - 1))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->pluck('total', 'date');

        // Rellenar los días faltantes con 0 ventas
        $salesDates = $dates->map(function ($date, $index) use ($salesData) {
            $dateKey = Carbon::now()->subDays($index)->format('Y-m-d');
            return [
                'date' => $date,
                'total' => $salesData->get($dateKey, 0)  // Si no hay ventas en esa fecha, se asigna 0
            ];
        });

        // Separar las fechas y los totales en dos colecciones
        $salesDatesLabels = $salesDates->pluck('date'); // Fechas formateadas en español
        $salesTotals = $salesDates->pluck('total');

        $inventoryItems = InventoryItem::pluck('name');
        $inventoryLevels = InventoryItem::pluck('quantity');

        $maxSales = $salesTotals->max();
        $yAxisMax = ceil($maxSales * 1.15);

        $maxInventoryLevel = $inventoryLevels->max();
        $yAxisInventoryMax = ceil($maxInventoryLevel * 1.15);  // Agrega un 10% de margen por encima del máximo
        return view('dashboard', compact('salesTotal', 'ordersToday', 'inventoryStatus', 'salesDatesLabels', 'salesTotals', 'inventoryItems', 'inventoryLevels', 'yAxisMax', 'yAxisInventoryMax'));
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
