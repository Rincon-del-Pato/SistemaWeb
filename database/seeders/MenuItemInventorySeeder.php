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
        // Asegúrate de que estos IDs coincidan con los ingredientes existentes
        // y no con los productos preenvasados
        DB::table('menu_item_inventory')->insert([
            //['menu_item_id' => 1, 'inventory_item_id' => 36, 'quantity_needed_per_unit' => 30, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 1, 'inventory_item_id' => 10, 'quantity_needed_per_unit' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 1, 'inventory_item_id' => 8, 'quantity_needed_per_unit' => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 1, 'inventory_item_id' => 6, 'quantity_needed_per_unit' => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            //['menu_item_id' => 1, 'inventory_item_id' => 37, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            //['menu_item_id' => 1, 'inventory_item_id' => 38, 'quantity_needed_per_unit' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 1, 'inventory_item_id' => 27, 'quantity_needed_per_unit' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            ['menu_item_id' => 2, 'inventory_item_id' => 1, 'quantity_needed_per_unit' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 2, 'inventory_item_id' => 2, 'quantity_needed_per_unit' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 2, 'inventory_item_id' => 11, 'quantity_needed_per_unit' => 20, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 2, 'inventory_item_id' => 6, 'quantity_needed_per_unit' => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 2, 'inventory_item_id' => 9, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 2, 'inventory_item_id' => 10, 'quantity_needed_per_unit' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            //['menu_item_id' => 2, 'inventory_item_id' => 37, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 2, 'inventory_item_id' => 27, 'quantity_needed_per_unit' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            ['menu_item_id' => 3, 'inventory_item_id' => 1, 'quantity_needed_per_unit' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 3, 'inventory_item_id' => 2, 'quantity_needed_per_unit' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 3, 'inventory_item_id' => 11, 'quantity_needed_per_unit' => 20, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 3, 'inventory_item_id' => 6, 'quantity_needed_per_unit' => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 3, 'inventory_item_id' => 9, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 3, 'inventory_item_id' => 10, 'quantity_needed_per_unit' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            //['menu_item_id' => 3, 'inventory_item_id' => 37, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 3, 'inventory_item_id' => 27, 'quantity_needed_per_unit' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            ['menu_item_id' => 4, 'inventory_item_id' => 1, 'quantity_needed_per_unit' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 4, 'inventory_item_id' => 11, 'quantity_needed_per_unit' => 20, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 4, 'inventory_item_id' => 6, 'quantity_needed_per_unit' => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 4, 'inventory_item_id' => 9, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 4, 'inventory_item_id' => 10, 'quantity_needed_per_unit' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            //['menu_item_id' => 4, 'inventory_item_id' => 37, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 4, 'inventory_item_id' => 27, 'quantity_needed_per_unit' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            ['menu_item_id' => 5, 'inventory_item_id' => 1, 'quantity_needed_per_unit' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 5, 'inventory_item_id' => 11, 'quantity_needed_per_unit' => 20, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 5, 'inventory_item_id' => 6, 'quantity_needed_per_unit' => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 5, 'inventory_item_id' => 9, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 5, 'inventory_item_id' => 10, 'quantity_needed_per_unit' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            //['menu_item_id' => 5, 'inventory_item_id' => 37, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 5, 'inventory_item_id' => 27, 'quantity_needed_per_unit' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            ['menu_item_id' => 6, 'inventory_item_id' => 1, 'quantity_needed_per_unit' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 6, 'inventory_item_id' => 11, 'quantity_needed_per_unit' => 20, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 6, 'inventory_item_id' => 6, 'quantity_needed_per_unit' => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 6, 'inventory_item_id' => 9, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 6, 'inventory_item_id' => 10, 'quantity_needed_per_unit' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           //['menu_item_id' => 6, 'inventory_item_id' => 37, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 6, 'inventory_item_id' => 27, 'quantity_needed_per_unit' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            ['menu_item_id' => 7, 'inventory_item_id' => 1, 'quantity_needed_per_unit' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 7, 'inventory_item_id' => 11, 'quantity_needed_per_unit' => 20, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 7, 'inventory_item_id' => 6, 'quantity_needed_per_unit' => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 7, 'inventory_item_id' => 9, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 7, 'inventory_item_id' => 10, 'quantity_needed_per_unit' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            //['menu_item_id' => 7, 'inventory_item_id' => 37, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 7, 'inventory_item_id' => 27, 'quantity_needed_per_unit' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            //['menu_item_id' => 8, 'inventory_item_id' => 36, 'quantity_needed_per_unit' => 30, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 8, 'inventory_item_id' => 10, 'quantity_needed_per_unit' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 8, 'inventory_item_id' => 8, 'quantity_needed_per_unit' => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 8, 'inventory_item_id' => 6, 'quantity_needed_per_unit' => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            //['menu_item_id' => 8, 'inventory_item_id' => 37, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            //['menu_item_id' => 8, 'inventory_item_id' => 38, 'quantity_needed_per_unit' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 8, 'inventory_item_id' => 27, 'quantity_needed_per_unit' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            ['menu_item_id' => 9, 'inventory_item_id' => 1, 'quantity_needed_per_unit' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 9, 'inventory_item_id' => 11, 'quantity_needed_per_unit' => 20, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 9, 'inventory_item_id' => 6, 'quantity_needed_per_unit' => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 9, 'inventory_item_id' => 9, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 9, 'inventory_item_id' => 10, 'quantity_needed_per_unit' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            //['menu_item_id' => 9, 'inventory_item_id' => 37, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 9, 'inventory_item_id' => 27, 'quantity_needed_per_unit' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            ['menu_item_id' => 10, 'inventory_item_id' => 1, 'quantity_needed_per_unit' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 10, 'inventory_item_id' => 11, 'quantity_needed_per_unit' => 20, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 10, 'inventory_item_id' => 6, 'quantity_needed_per_unit' => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 10, 'inventory_item_id' => 9, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 10, 'inventory_item_id' => 10, 'quantity_needed_per_unit' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            //['menu_item_id' => 10, 'inventory_item_id' => 37, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 10, 'inventory_item_id' => 27, 'quantity_needed_per_unit' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            ['menu_item_id' => 11, 'inventory_item_id' => 1, 'quantity_needed_per_unit' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 11, 'inventory_item_id' => 11, 'quantity_needed_per_unit' => 20, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 11, 'inventory_item_id' => 6, 'quantity_needed_per_unit' => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 11, 'inventory_item_id' => 9, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 11, 'inventory_item_id' => 10, 'quantity_needed_per_unit' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            //['menu_item_id' => 11, 'inventory_item_id' => 37, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 11, 'inventory_item_id' => 27, 'quantity_needed_per_unit' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            ['menu_item_id' => 12, 'inventory_item_id' => 1, 'quantity_needed_per_unit' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 12, 'inventory_item_id' => 11, 'quantity_needed_per_unit' => 20, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 12, 'inventory_item_id' => 6, 'quantity_needed_per_unit' => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 12, 'inventory_item_id' => 9, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 12, 'inventory_item_id' => 10, 'quantity_needed_per_unit' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            //['menu_item_id' => 12, 'inventory_item_id' => 37, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 12, 'inventory_item_id' => 27, 'quantity_needed_per_unit' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            ['menu_item_id' => 13, 'inventory_item_id' => 1, 'quantity_needed_per_unit' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 13, 'inventory_item_id' => 11, 'quantity_needed_per_unit' => 20, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 13, 'inventory_item_id' => 6, 'quantity_needed_per_unit' => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 13, 'inventory_item_id' => 9, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 13, 'inventory_item_id' => 10, 'quantity_needed_per_unit' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            //['menu_item_id' => 13, 'inventory_item_id' => 37, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 13, 'inventory_item_id' => 27, 'quantity_needed_per_unit' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            ['menu_item_id' => 14, 'inventory_item_id' => 1, 'quantity_needed_per_unit' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 14, 'inventory_item_id' => 11, 'quantity_needed_per_unit' => 20, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 14, 'inventory_item_id' => 6, 'quantity_needed_per_unit' => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 14, 'inventory_item_id' => 9, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 14, 'inventory_item_id' => 10, 'quantity_needed_per_unit' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            //['menu_item_id' => 14, 'inventory_item_id' => 37, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 14, 'inventory_item_id' => 27, 'quantity_needed_per_unit' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            ['menu_item_id' => 15, 'inventory_item_id' => 1, 'quantity_needed_per_unit' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 15, 'inventory_item_id' => 11, 'quantity_needed_per_unit' => 20, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 15, 'inventory_item_id' => 6, 'quantity_needed_per_unit' => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 15, 'inventory_item_id' => 9, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 15, 'inventory_item_id' => 10, 'quantity_needed_per_unit' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            //['menu_item_id' => 15, 'inventory_item_id' => 37, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 15, 'inventory_item_id' => 27, 'quantity_needed_per_unit' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            ['menu_item_id' => 16, 'inventory_item_id' => 1, 'quantity_needed_per_unit' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 16, 'inventory_item_id' => 2, 'quantity_needed_per_unit' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 16, 'inventory_item_id' => 11, 'quantity_needed_per_unit' => 20, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 16, 'inventory_item_id' => 6, 'quantity_needed_per_unit' => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 16, 'inventory_item_id' => 9, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 16, 'inventory_item_id' => 10, 'quantity_needed_per_unit' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            //['menu_item_id' => 16, 'inventory_item_id' => 37, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 16, 'inventory_item_id' => 27, 'quantity_needed_per_unit' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            ['menu_item_id' => 17, 'inventory_item_id' => 1, 'quantity_needed_per_unit' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 17, 'inventory_item_id' => 2, 'quantity_needed_per_unit' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 17, 'inventory_item_id' => 11, 'quantity_needed_per_unit' => 20, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 17, 'inventory_item_id' => 6, 'quantity_needed_per_unit' => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 17, 'inventory_item_id' => 9, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 17, 'inventory_item_id' => 10, 'quantity_needed_per_unit' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            //['menu_item_id' => 17, 'inventory_item_id' => 37, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 17, 'inventory_item_id' => 27, 'quantity_needed_per_unit' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            ['menu_item_id' => 18, 'inventory_item_id' => 2, 'quantity_needed_per_unit' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 18, 'inventory_item_id' => 11, 'quantity_needed_per_unit' => 20, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 18, 'inventory_item_id' => 6, 'quantity_needed_per_unit' => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 18, 'inventory_item_id' => 9, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 18, 'inventory_item_id' => 10, 'quantity_needed_per_unit' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            //['menu_item_id' => 18, 'inventory_item_id' => 37, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 18, 'inventory_item_id' => 27, 'quantity_needed_per_unit' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            ['menu_item_id' => 19, 'inventory_item_id' => 2, 'quantity_needed_per_unit' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 19, 'inventory_item_id' => 11, 'quantity_needed_per_unit' => 20, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 19, 'inventory_item_id' => 6, 'quantity_needed_per_unit' => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 19, 'inventory_item_id' => 9, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 19, 'inventory_item_id' => 10, 'quantity_needed_per_unit' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            //['menu_item_id' => 19, 'inventory_item_id' => 37, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 19, 'inventory_item_id' => 27, 'quantity_needed_per_unit' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            ['menu_item_id' => 20, 'inventory_item_id' => 18, 'quantity_needed_per_unit' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 20, 'inventory_item_id' => 8, 'quantity_needed_per_unit' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 20, 'inventory_item_id' => 11, 'quantity_needed_per_unit' => 8, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            //['menu_item_id' => 20, 'inventory_item_id' => 37, 'quantity_needed_per_unit' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 20, 'inventory_item_id' => 27, 'quantity_needed_per_unit' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 20, 'inventory_item_id' => 1, 'quantity_needed_per_unit' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 20, 'inventory_item_id' => 6, 'quantity_needed_per_unit' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 20, 'inventory_item_id' => 10, 'quantity_needed_per_unit' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 20, 'inventory_item_id' => 9, 'quantity_needed_per_unit' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            ['menu_item_id' => 21, 'inventory_item_id' => 1, 'quantity_needed_per_unit' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 21, 'inventory_item_id' => 11, 'quantity_needed_per_unit' => 20, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 21, 'inventory_item_id' => 6, 'quantity_needed_per_unit' => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 21, 'inventory_item_id' => 9, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 21, 'inventory_item_id' => 10, 'quantity_needed_per_unit' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            //['menu_item_id' => 21, 'inventory_item_id' => 37, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 21, 'inventory_item_id' => 27, 'quantity_needed_per_unit' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            ['menu_item_id' => 22, 'inventory_item_id' => 8, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 22, 'inventory_item_id' => 6, 'quantity_needed_per_unit' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            //['menu_item_id' => 22, 'inventory_item_id' => 37, 'quantity_needed_per_unit' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 22, 'inventory_item_id' => 20, 'quantity_needed_per_unit' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            //['menu_item_id' => 22, 'inventory_item_id' => 40, 'quantity_needed_per_unit' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            //['menu_item_id' => 22, 'inventory_item_id' => 38, 'quantity_needed_per_unit' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 22, 'inventory_item_id' => 27, 'quantity_needed_per_unit' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            ['menu_item_id' => 23, 'inventory_item_id' => 1, 'quantity_needed_per_unit' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 23, 'inventory_item_id' => 5, 'quantity_needed_per_unit' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            //['menu_item_id' => 23, 'inventory_item_id' => 37, 'quantity_needed_per_unit' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 23, 'inventory_item_id' => 11, 'quantity_needed_per_unit' => 8, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 23, 'inventory_item_id' => 8, 'quantity_needed_per_unit' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 23, 'inventory_item_id' => 27, 'quantity_needed_per_unit' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            //['menu_item_id' => 23, 'inventory_item_id' => 38, 'quantity_needed_per_unit' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 23, 'inventory_item_id' => 6, 'quantity_needed_per_unit' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 23, 'inventory_item_id' => 9, 'quantity_needed_per_unit' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 23, 'inventory_item_id' => 10, 'quantity_needed_per_unit' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['menu_item_id' => 23, 'inventory_item_id' => 11, 'quantity_needed_per_unit' => 9, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]




        ]);
    }
}
