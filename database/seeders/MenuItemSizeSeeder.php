<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MenuItemSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('menu_item_sizes')->insert([
            ['menu_item_id' => 1, 'size_id' => 1, 'price' => 3.50, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 1, 'size_id' => 2, 'price' => 5.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 2, 'size_id' => 1, 'price' => 2.50, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 2, 'size_id' => 2, 'price' => 4.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 3, 'size_id' => 1, 'price' => 3.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 3, 'size_id' => 2, 'price' => 4.50, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 4, 'size_id' => 1, 'price' => 1.50, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 4, 'size_id' => 2, 'price' => 2.80, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 5, 'size_id' => 1, 'price' => 4.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 5, 'size_id' => 2, 'price' => 6.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 6, 'size_id' => 1, 'price' => 2.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 6, 'size_id' => 2, 'price' => 3.50, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 7, 'size_id' => 1, 'price' => 1.80, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 7, 'size_id' => 2, 'price' => 3.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 8, 'size_id' => 1, 'price' => 3.50, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 8, 'size_id' => 2, 'price' => 5.50, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 9, 'size_id' => 1, 'price' => 2.20, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 9, 'size_id' => 2, 'price' => 3.80, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 10, 'size_id' => 1, 'price' => 3.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 10, 'size_id' => 2, 'price' => 4.40, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 11, 'size_id' => 1, 'price' => 5.50, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 11, 'size_id' => 2, 'price' => 7.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 12, 'size_id' => 1, 'price' => 2.80, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 12, 'size_id' => 2, 'price' => 4.20, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 13, 'size_id' => 1, 'price' => 1.50, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 13, 'size_id' => 2, 'price' => 3.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 14, 'size_id' => 1, 'price' => 4.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 14, 'size_id' => 2, 'price' => 5.80, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 15, 'size_id' => 1, 'price' => 2.20, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 15, 'size_id' => 2, 'price' => 3.50, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 16, 'size_id' => 1, 'price' => 3.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 16, 'size_id' => 2, 'price' => 4.80, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 17, 'size_id' => 1, 'price' => 1.80, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 17, 'size_id' => 2, 'price' => 2.50, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 18, 'size_id' => 1, 'price' => 3.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 18, 'size_id' => 2, 'price' => 4.60, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 19, 'size_id' => 1, 'price' => 3.20, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 19, 'size_id' => 2, 'price' => 4.40, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 20, 'size_id' => 1, 'price' => 2.70, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
