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
            // Plato 1
            ['menu_item_id' => 1, 'inventory_item_id' => 1, 'quantity_needed_per_unit' => 0.250, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Harina
            ['menu_item_id' => 1, 'inventory_item_id' => 2, 'quantity_needed_per_unit' => 0.100, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Azúcar

            // Plato 2
            ['menu_item_id' => 2, 'inventory_item_id' => 6, 'quantity_needed_per_unit' => 0.200, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Pechuga de Pollo
            ['menu_item_id' => 2, 'inventory_item_id' => 7, 'quantity_needed_per_unit' => 0.100, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Tomate

            // Plato 3
            ['menu_item_id' => 3, 'inventory_item_id' => 8, 'quantity_needed_per_unit' => 0.300, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Papas
            ['menu_item_id' => 3, 'inventory_item_id' => 9, 'quantity_needed_per_unit' => 0.050, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Cebolla

            // Plato 4
            ['menu_item_id' => 4, 'inventory_item_id' => 11, 'quantity_needed_per_unit' => 0.200, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Pechuga de Pavo
            ['menu_item_id' => 4, 'inventory_item_id' => 12, 'quantity_needed_per_unit' => 0.100, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Zanahoria

            // Plato 5
            ['menu_item_id' => 5, 'inventory_item_id' => 13, 'quantity_needed_per_unit' => 0.150, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Espinaca
            ['menu_item_id' => 5, 'inventory_item_id' => 14, 'quantity_needed_per_unit' => 0.100, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // Queso
        ]);
    }
}
