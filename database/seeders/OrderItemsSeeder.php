<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('order_items')->insert([
            ['order_id' => 1, 'menu_item_id' => 1, 'quantity' => 2, 'price' => 7.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 1, 'menu_item_id' => 2, 'quantity' => 1, 'price' => 32.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 1, 'menu_item_id' => 3, 'quantity' => 3, 'price' => 60.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 2, 'menu_item_id' => 4, 'quantity' => 1, 'price' => 22.10, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 2, 'menu_item_id' => 5, 'quantity' => 2, 'price' => 14.60, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 2, 'menu_item_id' => 6, 'quantity' => 1, 'price' => 23.80, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 3, 'menu_item_id' => 7, 'quantity' => 1, 'price' => 27.40, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 3, 'menu_item_id' => 8, 'quantity' => 2, 'price' => 19.20, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 3, 'menu_item_id' => 9, 'quantity' => 1, 'price' => 25.50, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 4, 'menu_item_id' => 10, 'quantity' => 3, 'price' => 17.10, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 4, 'menu_item_id' => 11, 'quantity' => 1, 'price' => 21.30, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 4, 'menu_item_id' => 12, 'quantity' => 2, 'price' => 16.80, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 5, 'menu_item_id' => 13, 'quantity' => 2, 'price' => 29.50, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 5, 'menu_item_id' => 14, 'quantity' => 1, 'price' => 35.70, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 5, 'menu_item_id' => 15, 'quantity' => 1, 'price' => 24.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 6, 'menu_item_id' => 16, 'quantity' => 1, 'price' => 20.50, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 6, 'menu_item_id' => 17, 'quantity' => 2, 'price' => 19.10, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 6, 'menu_item_id' => 18, 'quantity' => 3, 'price' => 13.90, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 7, 'menu_item_id' => 19, 'quantity' => 2, 'price' => 32.80, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 7, 'menu_item_id' => 20, 'quantity' => 1, 'price' => 30.50, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 7, 'menu_item_id' => 21, 'quantity' => 2, 'price' => 22.60, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 8, 'menu_item_id' => 22, 'quantity' => 1, 'price' => 14.70, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 8, 'menu_item_id' => 23, 'quantity' => 3, 'price' => 18.90, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 8, 'menu_item_id' => 24, 'quantity' => 2, 'price' => 25.40, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 9, 'menu_item_id' => 25, 'quantity' => 1, 'price' => 17.30, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 9, 'menu_item_id' => 26, 'quantity' => 2, 'price' => 22.10, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 9, 'menu_item_id' => 27, 'quantity' => 1, 'price' => 19.50, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 10, 'menu_item_id' => 28, 'quantity' => 3, 'price' => 93.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 10, 'menu_item_id' => 29, 'quantity' => 2, 'price' => 100.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 10, 'menu_item_id' => 30, 'quantity' => 1, 'price' => 45.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 11, 'menu_item_id' => 31, 'quantity' => 2, 'price' => 14.30, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 11, 'menu_item_id' => 32, 'quantity' => 1, 'price' => 22.40, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 11, 'menu_item_id' => 33, 'quantity' => 1, 'price' => 27.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 12, 'menu_item_id' => 34, 'quantity' => 1, 'price' => 24.80, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 12, 'menu_item_id' => 35, 'quantity' => 3, 'price' => 18.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 12, 'menu_item_id' => 36, 'quantity' => 2, 'price' => 19.20, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 13, 'menu_item_id' => 37, 'quantity' => 2, 'price' => 34.40, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 13, 'menu_item_id' => 38, 'quantity' => 1, 'price' => 26.90, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 13, 'menu_item_id' => 39, 'quantity' => 1, 'price' => 30.20, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 14, 'menu_item_id' => 40, 'quantity' => 3, 'price' => 22.60, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 14, 'menu_item_id' => 41, 'quantity' => 1, 'price' => 21.30, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 14, 'menu_item_id' => 42, 'quantity' => 2, 'price' => 16.70, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 15, 'menu_item_id' => 43, 'quantity' => 1, 'price' => 23.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 15, 'menu_item_id' => 44, 'quantity' => 3, 'price' => 26.90, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 15, 'menu_item_id' => 45, 'quantity' => 2, 'price' => 30.80, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 16, 'menu_item_id' => 1, 'quantity' => 1, 'price' => 15.50, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 16, 'menu_item_id' => 2, 'quantity' => 2, 'price' => 12.30, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 16, 'menu_item_id' => 3, 'quantity' => 1, 'price' => 18.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 17, 'menu_item_id' => 4, 'quantity' => 1, 'price' => 22.10, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 17, 'menu_item_id' => 5, 'quantity' => 2, 'price' => 14.60, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 17, 'menu_item_id' => 6, 'quantity' => 1, 'price' => 23.80, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 18, 'menu_item_id' => 7, 'quantity' => 1, 'price' => 27.40, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 18, 'menu_item_id' => 8, 'quantity' => 2, 'price' => 19.20, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 18, 'menu_item_id' => 9, 'quantity' => 1, 'price' => 25.50, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 19, 'menu_item_id' => 10, 'quantity' => 3, 'price' => 17.10, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 19, 'menu_item_id' => 11, 'quantity' => 1, 'price' => 21.30, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 19, 'menu_item_id' => 12, 'quantity' => 2, 'price' => 16.80, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 20, 'menu_item_id' => 13, 'quantity' => 2, 'price' => 29.50, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 20, 'menu_item_id' => 14, 'quantity' => 1, 'price' => 35.70, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 20, 'menu_item_id' => 15, 'quantity' => 1, 'price' => 24.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 21, 'menu_item_id' => 16, 'quantity' => 1, 'price' => 20.50, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 21, 'menu_item_id' => 17, 'quantity' => 2, 'price' => 19.10, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 21, 'menu_item_id' => 18, 'quantity' => 3, 'price' => 13.90, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 22, 'menu_item_id' => 19, 'quantity' => 2, 'price' => 32.80, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 22, 'menu_item_id' => 20, 'quantity' => 1, 'price' => 30.50, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 22, 'menu_item_id' => 21, 'quantity' => 2, 'price' => 22.60, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 23, 'menu_item_id' => 22, 'quantity' => 1, 'price' => 14.70, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 23, 'menu_item_id' => 23, 'quantity' => 3, 'price' => 18.90, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 23, 'menu_item_id' => 24, 'quantity' => 2, 'price' => 25.40, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 24, 'menu_item_id' => 25, 'quantity' => 1, 'price' => 17.30, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 24, 'menu_item_id' => 26, 'quantity' => 2, 'price' => 22.10, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 24, 'menu_item_id' => 27, 'quantity' => 1, 'price' => 19.50, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 25, 'menu_item_id' => 28, 'quantity' => 3, 'price' => 28.60, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 25, 'menu_item_id' => 29, 'quantity' => 2, 'price' => 33.70, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 25, 'menu_item_id' => 30, 'quantity' => 1, 'price' => 19.80, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
