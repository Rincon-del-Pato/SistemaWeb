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
        //
        // DB::table('inventory_items')->insert([
        //     ['supplier_id' => 1, 'name' => 'Harina', 'item_type' => 'Ingredientee', 'quantity' => 100, 'reorder_level' => 10,  'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 1, 'name' => 'Azúcar', 'item_type' => 'Ingredientee', 'quantity' => 50, 'reorder_level' => 5, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 1, 'name' => 'Aceite de Oliva', 'item_type' => 'Ingrediente', 'quantity' => 20, 'reorder_level' => 2, 'unit_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 1, 'name' => 'Sal', 'item_type' => 'Ingrediente', 'quantity' => 200, 'reorder_level' => 25, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 1, 'name' => 'Leche', 'item_type' => 'Ingrediente', 'quantity' => 80, 'reorder_level' => 10, 'unit_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 2, 'name' => 'Pechuga de Pollo', 'item_type' => 'Ingrediente', 'quantity' => 30, 'reorder_level' => 5, 'unit_id' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 2, 'name' => 'Tomate', 'item_type' => 'Ingrediente', 'quantity' => 50, 'reorder_level' => 7, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 2, 'name' => 'Papas', 'item_type' => 'Ingrediente', 'quantity' => 120, 'reorder_level' => 15, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 2, 'name' => 'Cebolla', 'item_type' => 'Ingrediente', 'quantity' => 70, 'reorder_level' => 10, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 2, 'name' => 'Ajo', 'item_type' => 'Ingrediente', 'quantity' => 100, 'reorder_level' => 20, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 3, 'name' => 'Cereal', 'item_type' => 'Preenvasado', 'quantity' => 100, 'reorder_level' => 15, 'unit_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 3, 'name' => 'Galletas', 'item_type' => 'Preenvasado', 'quantity' => 200, 'reorder_level' => 30, 'unit_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 3, 'name' => 'Chocolate', 'item_type' => 'Preenvasado', 'quantity' => 50, 'reorder_level' => 10, 'unit_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 3, 'name' => 'Leche en Polvo', 'item_type' => 'Preenvasado', 'quantity' => 40, 'reorder_level' => 5, 'unit_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 3, 'name' => 'Jugo de Naranja', 'item_type' => 'Preenvasado', 'quantity' => 30, 'reorder_level' => 5, 'unit_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 4, 'name' => 'Salsa de Tomate', 'item_type' => 'Preenvasado', 'quantity' => 60, 'reorder_level' => 10, 'unit_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 4, 'name' => 'Pasta', 'item_type' => 'Preenvasado', 'quantity' => 150, 'reorder_level' => 25, 'unit_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 4, 'name' => 'Arroz', 'item_type' => 'Preenvasado', 'quantity' => 100, 'reorder_level' => 20, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 4, 'name' => 'Mayonesa', 'item_type' => 'Preenvasado', 'quantity' => 40, 'reorder_level' => 5, 'unit_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 4, 'name' => 'Ketchup', 'item_type' => 'Preenvasado', 'quantity' => 120, 'reorder_level' => 15, 'unit_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 5, 'name' => 'Pechuga de Pavo', 'item_type' => 'Ingrediente', 'quantity' => 25, 'reorder_level' => 5, 'unit_id' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 5, 'name' => 'Zanahoria', 'item_type' => 'Ingrediente', 'quantity' => 60, 'reorder_level' => 8, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 5, 'name' => 'Espinaca', 'item_type' => 'Ingrediente', 'quantity' => 90, 'reorder_level' => 10, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 5, 'name' => 'Queso', 'item_type' => 'Ingrediente', 'quantity' => 30, 'reorder_level' => 5, 'unit_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 5, 'name' => 'Yogur', 'item_type' => 'Ingrediente', 'quantity' => 50, 'reorder_level' => 7, 'unit_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 1, 'name' => 'Tomate Cherry', 'item_type' => 'Ingrediente', 'quantity' => 40, 'reorder_level' => 5, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 1, 'name' => 'Pechuga de Pollo Congelada', 'item_type' => 'Ingrediente', 'quantity' => 25, 'reorder_level' => 3, 'unit_id' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 1, 'name' => 'Manteca', 'item_type' => 'Ingrediente', 'quantity' => 100, 'reorder_level' => 10, 'unit_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 1, 'name' => 'Pescado', 'item_type' => 'Ingrediente', 'quantity' => 35, 'reorder_level' => 6, 'unit_id' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 1, 'name' => 'Miel', 'item_type' => 'Ingrediente', 'quantity' => 15, 'reorder_level' => 3, 'unit_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 2, 'name' => 'Mantequilla', 'item_type' => 'Ingrediente', 'quantity' => 80, 'reorder_level' => 10, 'unit_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 2, 'name' => 'Pimiento', 'item_type' => 'Ingrediente', 'quantity' => 50, 'reorder_level' => 5, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 2, 'name' => 'Almendras', 'item_type' => 'Ingrediente', 'quantity' => 60, 'reorder_level' => 7, 'unit_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 2, 'name' => 'Pan', 'item_type' => 'Preenvasado', 'quantity' => 120, 'reorder_level' => 15, 'unit_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 2, 'name' => 'Aguacate', 'item_type' => 'Ingrediente', 'quantity' => 40, 'reorder_level' => 5, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 3, 'name' => 'Leche Condensada', 'item_type' => 'Preenvasado', 'quantity' => 25, 'reorder_level' => 5, 'unit_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 3, 'name' => 'Café Instantáneo', 'item_type' => 'Preenvasado', 'quantity' => 90, 'reorder_level' => 15, 'unit_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 3, 'name' => 'Soda', 'item_type' => 'Preenvasado', 'quantity' => 200, 'reorder_level' => 25, 'unit_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 3, 'name' => 'Té', 'item_type' => 'Preenvasado', 'quantity' => 50, 'reorder_level' => 10, 'unit_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 3, 'name' => 'Frutos Secos', 'item_type' => 'Preenvasado', 'quantity' => 30, 'reorder_level' => 5, 'unit_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 4, 'name' => 'Galletas Saladas', 'item_type' => 'Preenvasado', 'quantity' => 100, 'reorder_level' => 15, 'unit_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 4, 'name' => 'Sopa Instantánea', 'item_type' => 'Preenvasado', 'quantity' => 150, 'reorder_level' => 20, 'unit_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 4, 'name' => 'Gelatina', 'item_type' => 'Preenvasado', 'quantity' => 90, 'reorder_level' => 15, 'unit_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 4, 'name' => 'Café Molido', 'item_type' => 'Preenvasado', 'quantity' => 70, 'reorder_level' => 10, 'unit_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 4, 'name' => 'Fruta Deshidratada', 'item_type' => 'Preenvasado', 'quantity' => 50, 'reorder_level' => 8, 'unit_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 5, 'name' => 'Frijoles', 'item_type' => 'Ingrediente', 'quantity' => 130, 'reorder_level' => 20, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 5, 'name' => 'Lentejas', 'item_type' => 'Ingrediente', 'quantity' => 90, 'reorder_level' => 15, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 5, 'name' => 'Quinoa', 'item_type' => 'Ingrediente', 'quantity' => 40, 'reorder_level' => 5, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 5, 'name' => 'Acelga', 'item_type' => 'Ingrediente', 'quantity' => 60, 'reorder_level' => 10, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 5, 'name' => 'Pepino', 'item_type' => 'Ingrediente', 'quantity' => 100, 'reorder_level' => 15, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 1, 'name' => 'Pistachos', 'item_type' => 'Ingrediente', 'quantity' => 40, 'reorder_level' => 5, 'unit_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 1, 'name' => 'Frambuesas', 'item_type' => 'Ingrediente', 'quantity' => 50, 'reorder_level' => 7, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 1, 'name' => 'Cúrcuma', 'item_type' => 'Ingrediente', 'quantity' => 60, 'reorder_level' => 10, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 1, 'name' => 'Pechuga de Pollo Fresca', 'item_type' => 'Ingrediente', 'quantity' => 80, 'reorder_level' => 12, 'unit_id' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 1, 'name' => 'Berenjena', 'item_type' => 'Ingrediente', 'quantity' => 70, 'reorder_level' => 10, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 2, 'name' => 'Kiwis', 'item_type' => 'Ingrediente', 'quantity' => 50, 'reorder_level' => 5, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 2, 'name' => 'Huevo', 'item_type' => 'Ingrediente', 'quantity' => 90, 'reorder_level' => 12, 'unit_id' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['supplier_id' => 2, 'name' => 'Tomates Secos', 'item_type' => 'Ingrediente', 'quantity' => 30, 'reorder_level' => 4, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        // ]);

        DB::table('inventory_items')->insert([
            ['supplier_id' => 1, 'name' => 'Harina', 'item_type' => 'Ingrediente', 'quantity' => 100, 'reorder_level' => 10, 'cost_price' => 1.20, 'flavor' => null, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 1, 'name' => 'Azúcar', 'item_type' => 'Ingrediente', 'quantity' => 50, 'reorder_level' => 5, 'cost_price' => 0.80, 'flavor' => null, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 1, 'name' => 'Aceite de Oliva', 'item_type' => 'Ingrediente', 'quantity' => 20, 'reorder_level' => 2, 'cost_price' => 10.50, 'flavor' => null, 'unit_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 1, 'name' => 'Sal', 'item_type' => 'Ingrediente', 'quantity' => 200, 'reorder_level' => 25, 'cost_price' => 0.30, 'flavor' => null, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 1, 'name' => 'Leche', 'item_type' => 'Ingrediente', 'quantity' => 80, 'reorder_level' => 10, 'cost_price' => 1.50, 'flavor' => null, 'unit_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 2, 'name' => 'Pechuga de Pollo', 'item_type' => 'Ingrediente', 'quantity' => 30, 'reorder_level' => 5, 'cost_price' => 6.50, 'flavor' => null, 'unit_id' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 2, 'name' => 'Tomate', 'item_type' => 'Ingrediente', 'quantity' => 50, 'reorder_level' => 7, 'cost_price' => 0.70, 'flavor' => null, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 2, 'name' => 'Papas', 'item_type' => 'Ingrediente', 'quantity' => 120, 'reorder_level' => 15, 'cost_price' => 0.50, 'flavor' => null, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 2, 'name' => 'Cebolla', 'item_type' => 'Ingrediente', 'quantity' => 70, 'reorder_level' => 10, 'cost_price' => 0.40, 'flavor' => null, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 2, 'name' => 'Ajo', 'item_type' => 'Ingrediente', 'quantity' => 100, 'reorder_level' => 20, 'cost_price' => 0.20, 'flavor' => null, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 3, 'name' => 'Cereal', 'item_type' => 'Preenvasado', 'quantity' => 100, 'reorder_level' => 15, 'cost_price' => 3.80, 'flavor' => null, 'unit_id' => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 3, 'name' => 'Galletas', 'item_type' => 'Preenvasado', 'quantity' => 200, 'reorder_level' => 30, 'cost_price' => 2.50, 'flavor' => null, 'unit_id' => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 3, 'name' => 'Chocolate', 'item_type' => 'Preenvasado', 'quantity' => 50, 'reorder_level' => 10, 'cost_price' => 1.20, 'flavor' => 'Chocolate', 'unit_id' => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 3, 'name' => 'Leche en Polvo', 'item_type' => 'Preenvasado', 'quantity' => 40, 'reorder_level' => 5, 'cost_price' => 1.50, 'flavor' => null, 'unit_id' => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 3, 'name' => 'Jugo de Naranja', 'item_type' => 'Preenvasado', 'quantity' => 30, 'reorder_level' => 6, 'cost_price' => 1.80, 'flavor' => 'Naranja', 'unit_id' => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 4, 'name' => 'Salsa de Tomate', 'item_type' => 'Preenvasado', 'quantity' => 60, 'reorder_level' => 10, 'cost_price' => 2.00, 'flavor' => null, 'unit_id' => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 4, 'name' => 'Pasta', 'item_type' => 'Preenvasado', 'quantity' => 150, 'reorder_level' => 25, 'cost_price' => 1.80, 'flavor' => null, 'unit_id' => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 4, 'name' => 'Arroz', 'item_type' => 'Preenvasado', 'quantity' => 100, 'reorder_level' => 20, 'cost_price' => 1.10, 'flavor' => null, 'unit_id' => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 4, 'name' => 'Mayonesa', 'item_type' => 'Preenvasado', 'quantity' => 40, 'reorder_level' => 5, 'cost_price' => 1.50, 'flavor' => null, 'unit_id' => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 4, 'name' => 'Ketchup', 'item_type' => 'Preenvasado', 'quantity' => 120, 'reorder_level' => 15, 'cost_price' => 2.00, 'flavor' => null, 'unit_id' => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 5, 'name' => 'Pechuga de Pavo', 'item_type' => 'Ingrediente', 'quantity' => 25, 'reorder_level' => 5, 'cost_price' => 5.00, 'flavor' => null, 'unit_id' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 5, 'name' => 'Zanahoria', 'item_type' => 'Ingrediente', 'quantity' => 60, 'reorder_level' => 8, 'cost_price' => 0.80, 'flavor' => null, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 5, 'name' => 'Espinaca', 'item_type' => 'Ingrediente', 'quantity' => 90, 'reorder_level' => 10, 'cost_price' => 0.90, 'flavor' => null, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 5, 'name' => 'Queso', 'item_type' => 'Ingrediente', 'quantity' => 30, 'reorder_level' => 5, 'cost_price' => 3.50, 'flavor' => null, 'unit_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 5, 'name' => 'Yogur', 'item_type' => 'Ingrediente', 'quantity' => 50, 'reorder_level' => 7, 'cost_price' => 2.20, 'flavor' => 'Natural', 'unit_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 1, 'name' => 'Tomate Cherry', 'item_type' => 'Ingrediente', 'quantity' => 40, 'reorder_level' => 5, 'cost_price' => 1.10, 'flavor' => null, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 1, 'name' => 'Pechuga de Pollo Congelada', 'item_type' => 'Ingrediente', 'quantity' => 25, 'reorder_level' => 3, 'cost_price' => 6.00, 'flavor' => null, 'unit_id' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 3, 'name' => 'Soda', 'item_type' => 'Preenvasado', 'quantity' => 200, 'reorder_level' => 25, 'cost_price' => 1.30, 'flavor' => 'Cola', 'unit_id' => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 3, 'name' => 'Té', 'item_type' => 'Preenvasado', 'quantity' => 50, 'reorder_level' => 10, 'cost_price' => 1.40, 'flavor' => 'Limón', 'unit_id' => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 4, 'name' => 'Galletas Saladas', 'item_type' => 'Preenvasado', 'quantity' => 100, 'reorder_level' => 15, 'cost_price' => 1.20, 'flavor' => null, 'unit_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 5, 'name' => 'Pan', 'item_type' => 'Preenvasado', 'quantity' => 150, 'reorder_level' => 20, 'cost_price' => 2.50, 'flavor' => null, 'unit_id' => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 1, 'name' => 'Miel', 'item_type' => 'Ingrediente', 'quantity' => 15, 'reorder_level' => 3, 'cost_price' => 2.80, 'flavor' => null, 'unit_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

    }
}
