<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\InventoryItem;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //
    public function getDashboardData()
    {
        try {
            $daysToShow = 14;

            // Datos básicos
            $salesTotal = Order::sum('total');
            $ordersToday = Order::whereDate('created_at', now()->toDateString())->count();
            $inventoryStatus = InventoryItem::whereColumn('quantity', '<=', 'reorder_level')->get();

            // Ventas diarias
            $salesData = Order::selectRaw('DATE(created_at) as date, SUM(total) as total')
                ->where('created_at', '>=', now()->subDays($daysToShow))
                ->groupBy('date')
                ->orderBy('date')
                ->get();

            // Formatear fechas y totales
            $salesDatesLabels = [];
            $salesTotals = [];

            // Asegurar que tengamos datos para todos los días, incluso sin ventas
            for ($i = $daysToShow - 1; $i >= 0; $i--) {
                $date = now()->subDays($i);
                $formattedDate = $date->format('d/m'); // Formato más corto para móvil
                $salesDatesLabels[] = $formattedDate;

                $dayTotal = $salesData->where('date', $date->format('Y-m-d'))->first();
                $salesTotals[] = $dayTotal ? round($dayTotal->total, 2) : 0;
            }

            // Datos de inventario simplificados para móvil
            $inventory = InventoryItem::select('name', 'quantity')
                ->orderBy('quantity', 'desc')
                ->limit(10) // Limitar a 10 items para mejor visualización en móvil
                ->get();

            $inventoryItems = $inventory->pluck('name')->toArray();
            $inventoryLevels = $inventory->pluck('quantity')->toArray();

            // Calcular límites de ejes
            $maxSales = max($salesTotals);
            $yAxisMax = ceil($maxSales * 1.15);

            $maxInventory = max($inventoryLevels ?: [0]);
            $yAxisInventoryMax = ceil($maxInventory * 1.15);

            // Estructura de respuesta unificada
            return response()->json([
                'salesTotal' => round($salesTotal, 2),
                'ordersToday' => $ordersToday,
                'inventoryStatus' => $inventoryStatus,
                'salesDatesLabels' => $salesDatesLabels,
                'salesTotals' => $salesTotals,
                'inventoryItems' => $inventoryItems,
                'inventoryLevels' => $inventoryLevels,
                'yAxisMax' => $yAxisMax,
                'yAxisInventoryMax' => $yAxisInventoryMax
            ]);

        } catch (\Exception $e) {
            Log::error('Dashboard Error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Error al cargar los datos del dashboard',
                'message' => $e->getMessage()
            ], 500);
        }
    }


    // public function getInventoryData()
    // {
    //     $inventoryItems = InventoryItem::select('name', 'quantity')->get();
    //     return response()->json($inventoryItems);
    // }

    // public function getSalesData()
    // {
    //     $daysToShow = 14;
    //     $dates = collect();
    //     for ($i = $daysToShow - 1; $i >= 0; $i--) {
    //         $dates->push(Carbon::now()->subDays($i)->format('Y-m-d'));
    //     }

    //     $salesData = Order::selectRaw('DATE(created_at) as date, SUM(total) as total')
    //         ->where('created_at', '>=', Carbon::now()->subDays($daysToShow - 1))
    //         ->groupBy('date')
    //         ->orderBy('date', 'ASC')
    //         ->pluck('total', 'date');

    //     $sales = $dates->map(function ($date) use ($salesData) {
    //         return [
    //             'date' => $date,
    //             'total' => $salesData->get($date, 0),
    //         ];
    //     });

    //     return response()->json($sales);
    // }
}
