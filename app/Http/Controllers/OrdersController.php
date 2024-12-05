
<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function edit(Order $order)
    {
        $table = $order->table;
        $categories = Category::all();
        $menus = MenuItem::with('sizes', 'category')->get();
        $orderItems = $order->orderItems->map(function($item) {
            return [
                'menuId' => $item->menu_item_id,
                'name' => $item->menu_item->name,
                'price' => $item->price,
                'sizeName' => $item->size_name,
                'quantity' => $item->quantity,
                'subtotal' => $item->price * $item->quantity,
                'special_requests' => $item->special_requests
            ];
        });

        return view('orders.create', [
            'table' => $table,
            'categories' => $categories,
            'menus' => $menus,
            'customerCount' => $order->customer_count,
            'existingOrder' => $order,
            'existingOrderItems' => $orderItems
        ]);
    }
}