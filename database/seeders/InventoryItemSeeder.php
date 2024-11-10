<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventoryItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('inventory_items')->insert([
            ['name' => 'Tomate', 'quantity' => 5000, 'reorder_level' => 1000, 'unit_id' => 1, 'supplier_id' => 3],
            ['name' => 'Cebolla', 'quantity' => 3000, 'reorder_level' => 500, 'unit_id' => 1, 'supplier_id' => 3],
            ['name' => 'Pimiento', 'quantity' => 2000, 'reorder_level' => 500, 'unit_id' => 1, 'supplier_id' => 3],
            ['name' => 'Ajo', 'quantity' => 500, 'reorder_level' => 100, 'unit_id' => 1, 'supplier_id' => 3],
            ['name' => 'Aceite de Oliva', 'quantity' => 2000, 'reorder_level' => 500, 'unit_id' => 2, 'supplier_id' => 5],
            ['name' => 'Sal', 'quantity' => 1000, 'reorder_level' => 200, 'unit_id' => 1, 'supplier_id' => 5],
            ['name' => 'Pimienta', 'quantity' => 300, 'reorder_level' => 100, 'unit_id' => 1, 'supplier_id' => 5],
            ['name' => 'Carne de Res', 'quantity' => 8000, 'reorder_level' => 2000, 'unit_id' => 1, 'supplier_id' => 2],
            ['name' => 'Papas', 'quantity' => 10000, 'reorder_level' => 3000, 'unit_id' => 1, 'supplier_id' => 3],
            ['name' => 'Pescado', 'quantity' => 5000, 'reorder_level' => 1000, 'unit_id' => 1, 'supplier_id' => 1],
            ['name' => 'Limón', 'quantity' => 500, 'reorder_level' => 100, 'unit_id' => 3, 'supplier_id' => 3],
            ['name' => 'Lechuga', 'quantity' => 2000, 'reorder_level' => 500, 'unit_id' => 1, 'supplier_id' => 3],
            ['name' => 'Cilantro', 'quantity' => 500, 'reorder_level' => 100, 'unit_id' => 1, 'supplier_id' => 3],
            ['name' => 'Arroz', 'quantity' => 10000, 'reorder_level' => 3000, 'unit_id' => 1, 'supplier_id' => 3],
            ['name' => 'Pollo', 'quantity' => 7000, 'reorder_level' => 2000, 'unit_id' => 1, 'supplier_id' => 2],
        ]);
    }
}
