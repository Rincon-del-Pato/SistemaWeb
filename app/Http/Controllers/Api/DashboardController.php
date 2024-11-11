<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\InventoryItem;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //
    public function getDashboardData()
    {
        $salesTotal = Order::sum('total');
        $ordersToday = Order::whereDate('created_at', now()->toDateString())->count();
        $inventoryStatus = InventoryItem::whereColumn('quantity', '<=', 'reorder_level')->count();

        return response()->json([
            'sales_total' => $salesTotal,
            'orders_today' => $ordersToday,
            'inventory_status' => $inventoryStatus,
        ]);
    }

    public function getInventoryData()
    {
        $inventoryItems = InventoryItem::select('name', 'quantity')->get();
        return response()->json($inventoryItems);
    }

    public function getSalesData()
    {
        $daysToShow = 14;
        $dates = collect();
        for ($i = $daysToShow - 1; $i >= 0; $i--) {
            $dates->push(Carbon::now()->subDays($i)->format('Y-m-d'));
        }

        $salesData = Order::selectRaw('DATE(created_at) as date, SUM(total) as total')
            ->where('created_at', '>=', Carbon::now()->subDays($daysToShow - 1))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->pluck('total', 'date');

        $sales = $dates->map(function ($date) use ($salesData) {
            return [
                'date' => $date,
                'total' => $salesData->get($date, 0),
            ];
        });

        return response()->json($sales);
    }
}
