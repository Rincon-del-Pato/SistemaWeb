<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InventoryItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ingredientes (sin num_units)
        DB::table('inventory_items')->insert([
            ['supplier_id' => 1, 'name' => 'Harina', 'item_type' => 'Ingrediente', 'quantity' => 100, 'reorder_level' => 10, 'cost_price' => 1.20, 'num_units' => null, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 1, 'name' => 'Azúcar', 'item_type' => 'Ingrediente', 'quantity' => 50, 'reorder_level' => 5, 'cost_price' => 0.80, 'num_units' => null, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 1, 'name' => 'Aceite de Oliva', 'item_type' => 'Ingrediente', 'quantity' => 20, 'reorder_level' => 2, 'cost_price' => 10.50, 'num_units' => null, 'unit_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 1, 'name' => 'Sal', 'item_type' => 'Ingrediente', 'quantity' => 200, 'reorder_level' => 25, 'cost_price' => 0.30, 'num_units' => null, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 1, 'name' => 'Leche', 'item_type' => 'Ingrediente', 'quantity' => 80, 'reorder_level' => 10, 'cost_price' => 1.50, 'num_units' => null, 'unit_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 2, 'name' => 'Pechuga de Pollo', 'item_type' => 'Ingrediente', 'quantity' => 30, 'reorder_level' => 5, 'cost_price' => 6.50, 'num_units' => null, 'unit_id' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 2, 'name' => 'Tomate', 'item_type' => 'Ingrediente', 'quantity' => 50, 'reorder_level' => 7, 'cost_price' => 0.70, 'num_units' => null, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 2, 'name' => 'Papas', 'item_type' => 'Ingrediente', 'quantity' => 120, 'reorder_level' => 15, 'cost_price' => 0.50, 'num_units' => null, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 2, 'name' => 'Cebolla', 'item_type' => 'Ingrediente', 'quantity' => 70, 'reorder_level' => 10, 'cost_price' => 0.40, 'num_units' => null, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 2, 'name' => 'Ajo', 'item_type' => 'Ingrediente', 'quantity' => 100, 'reorder_level' => 20, 'cost_price' => 0.20, 'num_units' => null, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 5, 'name' => 'Pechuga de Pavo', 'item_type' => 'Ingrediente', 'quantity' => 25, 'reorder_level' => 5, 'cost_price' => 5.00, 'num_units' => null, 'unit_id' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 5, 'name' => 'Zanahoria', 'item_type' => 'Ingrediente', 'quantity' => 60, 'reorder_level' => 8, 'cost_price' => 0.80, 'num_units' => null, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 5, 'name' => 'Espinaca', 'item_type' => 'Ingrediente', 'quantity' => 90, 'reorder_level' => 10, 'cost_price' => 0.90, 'num_units' => null, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 5, 'name' => 'Queso', 'item_type' => 'Ingrediente', 'quantity' => 30, 'reorder_level' => 5, 'cost_price' => 3.50, 'num_units' => null, 'unit_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 5, 'name' => 'Yogur', 'item_type' => 'Ingrediente', 'quantity' => 50, 'reorder_level' => 7, 'cost_price' => 2.20, 'num_units' => null, 'unit_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 1, 'name' => 'Tomate Cherry', 'item_type' => 'Ingrediente', 'quantity' => 40, 'reorder_level' => 5, 'cost_price' => 1.10, 'num_units' => null, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 1, 'name' => 'Pechuga de Pollo Congelada', 'item_type' => 'Ingrediente', 'quantity' => 25, 'reorder_level' => 3, 'cost_price' => 6.00, 'num_units' => null, 'unit_id' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 1, 'name' => 'Miel', 'item_type' => 'Ingrediente', 'quantity' => 15, 'reorder_level' => 3, 'cost_price' => 2.80, 'num_units' => null, 'unit_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

        // Productos Preenvasados para venta (con num_units y quantity como contenido)
        DB::table('inventory_items')->insert([
            // Bebidas
            ['supplier_id' => 3, 'name' => 'Coca Cola', 'item_type' => 'Preenvasado', 'quantity' => 500, 'reorder_level' => 15, 'cost_price' => 3.80, 'num_units' => 24, 'unit_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // 500ml, stock 24 unidades
            ['supplier_id' => 3, 'name' => 'Inca Kola', 'item_type' => 'Preenvasado', 'quantity' => 500, 'reorder_level' => 15, 'cost_price' => 3.80, 'num_units' => 24, 'unit_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 3, 'name' => 'Sprite', 'item_type' => 'Preenvasado', 'quantity' => 500, 'reorder_level' => 12, 'cost_price' => 3.50, 'num_units' => 20, 'unit_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 3, 'name' => 'Agua San Luis', 'item_type' => 'Preenvasado', 'quantity' => 625, 'reorder_level' => 20, 'cost_price' => 2.50, 'num_units' => 30, 'unit_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // 625ml

            // Snacks
            ['supplier_id' => 4, 'name' => 'Papitas Lay\'s', 'item_type' => 'Preenvasado', 'quantity' => 150, 'reorder_level' => 10, 'cost_price' => 2.00, 'num_units' => 15, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // 150g
            ['supplier_id' => 4, 'name' => 'Doritos', 'item_type' => 'Preenvasado', 'quantity' => 200, 'reorder_level' => 8, 'cost_price' => 2.50, 'num_units' => 12, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // 200g
            ['supplier_id' => 4, 'name' => 'Piqueo Snax', 'item_type' => 'Preenvasado', 'quantity' => 225, 'reorder_level' => 8, 'cost_price' => 2.30, 'num_units' => 12, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            // Otros
            ['supplier_id' => 5, 'name' => 'Triple de Pollo', 'item_type' => 'Preenvasado', 'quantity' => 1, 'reorder_level' => 5, 'cost_price' => 4.50, 'num_units' => 8, 'unit_id' => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // 1 unidad, stock 8
            ['supplier_id' => 5, 'name' => 'Empanada de Carne', 'item_type' => 'Preenvasado', 'quantity' => 1, 'reorder_level' => 6, 'cost_price' => 3.50, 'num_units' => 10, 'unit_id' => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 5, 'name' => 'Brownie', 'item_type' => 'Preenvasado', 'quantity' => 100, 'reorder_level' => 8, 'cost_price' => 2.00, 'num_units' => 15, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // 100g por porción
        ]);
    }
}
