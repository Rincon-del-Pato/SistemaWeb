<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MenuItemInventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('menu_item_inventory')->insert([
            ['menu_item_id' => 1, 'inventory_item_id' => 1, 'quantity_needed_per_unit' => 2.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 1, 'inventory_item_id' => 3, 'quantity_needed_per_unit' => 1.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 2, 'inventory_item_id' => 2, 'quantity_needed_per_unit' => 3.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 2, 'inventory_item_id' => 4, 'quantity_needed_per_unit' => 2.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 3, 'inventory_item_id' => 5, 'quantity_needed_per_unit' => 1.50, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 3, 'inventory_item_id' => 6, 'quantity_needed_per_unit' => 1.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 4, 'inventory_item_id' => 7, 'quantity_needed_per_unit' => 0.50, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 4, 'inventory_item_id' => 8, 'quantity_needed_per_unit' => 0.30, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 5, 'inventory_item_id' => 9, 'quantity_needed_per_unit' => 1.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 5, 'inventory_item_id' => 10, 'quantity_needed_per_unit' => 0.20, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 6, 'inventory_item_id' => 11, 'quantity_needed_per_unit' => 2.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 6, 'inventory_item_id' => 12, 'quantity_needed_per_unit' => 3.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 7, 'inventory_item_id' => 13, 'quantity_needed_per_unit' => 1.50, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 7, 'inventory_item_id' => 14, 'quantity_needed_per_unit' => 1.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 8, 'inventory_item_id' => 15, 'quantity_needed_per_unit' => 1.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 8, 'inventory_item_id' => 16, 'quantity_needed_per_unit' => 0.75, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 9, 'inventory_item_id' => 17, 'quantity_needed_per_unit' => 1.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 9, 'inventory_item_id' => 18, 'quantity_needed_per_unit' => 0.50, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 10, 'inventory_item_id' => 19, 'quantity_needed_per_unit' => 0.25, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 10, 'inventory_item_id' => 20, 'quantity_needed_per_unit' => 0.10, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 11, 'inventory_item_id' => 21, 'quantity_needed_per_unit' => 1.50, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 11, 'inventory_item_id' => 22, 'quantity_needed_per_unit' => 0.80, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 12, 'inventory_item_id' => 23, 'quantity_needed_per_unit' => 1.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 12, 'inventory_item_id' => 24, 'quantity_needed_per_unit' => 0.30, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 13, 'inventory_item_id' => 25, 'quantity_needed_per_unit' => 0.50, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 13, 'inventory_item_id' => 26, 'quantity_needed_per_unit' => 1.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 14, 'inventory_item_id' => 27, 'quantity_needed_per_unit' => 0.70, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 14, 'inventory_item_id' => 28, 'quantity_needed_per_unit' => 1.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 15, 'inventory_item_id' => 29, 'quantity_needed_per_unit' => 2.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 15, 'inventory_item_id' => 30, 'quantity_needed_per_unit' => 1.00, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
