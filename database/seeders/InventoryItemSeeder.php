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
        DB::table('inventory_items')->insert([
            ['supplier_id' => 1, 'name' => 'Harina', 'item_type' => 'ingredient', 'quantity' => 100, 'reorder_level' => 10, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 1, 'name' => 'Azúcar', 'item_type' => 'ingredient', 'quantity' => 50, 'reorder_level' => 5, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 1, 'name' => 'Aceite de Oliva', 'item_type' => 'ingredient', 'quantity' => 20, 'reorder_level' => 2, 'unit_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 1, 'name' => 'Sal', 'item_type' => 'ingredient', 'quantity' => 200, 'reorder_level' => 25, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 1, 'name' => 'Leche', 'item_type' => 'ingredient', 'quantity' => 80, 'reorder_level' => 10, 'unit_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 2, 'name' => 'Pechuga de Pollo', 'item_type' => 'ingredient', 'quantity' => 30, 'reorder_level' => 5, 'unit_id' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 2, 'name' => 'Tomate', 'item_type' => 'ingredient', 'quantity' => 50, 'reorder_level' => 7, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 2, 'name' => 'Papas', 'item_type' => 'ingredient', 'quantity' => 120, 'reorder_level' => 15, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 2, 'name' => 'Cebolla', 'item_type' => 'ingredient', 'quantity' => 70, 'reorder_level' => 10, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 2, 'name' => 'Ajo', 'item_type' => 'ingredient', 'quantity' => 100, 'reorder_level' => 20, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 3, 'name' => 'Cereal', 'item_type' => 'prepackaged', 'quantity' => 100, 'reorder_level' => 15, 'unit_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 3, 'name' => 'Galletas', 'item_type' => 'prepackaged', 'quantity' => 200, 'reorder_level' => 30, 'unit_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 3, 'name' => 'Chocolate', 'item_type' => 'prepackaged', 'quantity' => 50, 'reorder_level' => 10, 'unit_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 3, 'name' => 'Leche en Polvo', 'item_type' => 'prepackaged', 'quantity' => 40, 'reorder_level' => 5, 'unit_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 3, 'name' => 'Jugo de Naranja', 'item_type' => 'prepackaged', 'quantity' => 30, 'reorder_level' => 5, 'unit_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 4, 'name' => 'Salsa de Tomate', 'item_type' => 'prepackaged', 'quantity' => 60, 'reorder_level' => 10, 'unit_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 4, 'name' => 'Pasta', 'item_type' => 'prepackaged', 'quantity' => 150, 'reorder_level' => 25, 'unit_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 4, 'name' => 'Arroz', 'item_type' => 'prepackaged', 'quantity' => 100, 'reorder_level' => 20, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 4, 'name' => 'Mayonesa', 'item_type' => 'prepackaged', 'quantity' => 40, 'reorder_level' => 5, 'unit_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 4, 'name' => 'Ketchup', 'item_type' => 'prepackaged', 'quantity' => 120, 'reorder_level' => 15, 'unit_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 5, 'name' => 'Pechuga de Pavo', 'item_type' => 'ingredient', 'quantity' => 25, 'reorder_level' => 5, 'unit_id' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 5, 'name' => 'Zanahoria', 'item_type' => 'ingredient', 'quantity' => 60, 'reorder_level' => 8, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 5, 'name' => 'Espinaca', 'item_type' => 'ingredient', 'quantity' => 90, 'reorder_level' => 10, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 5, 'name' => 'Queso', 'item_type' => 'ingredient', 'quantity' => 30, 'reorder_level' => 5, 'unit_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 5, 'name' => 'Yogur', 'item_type' => 'ingredient', 'quantity' => 50, 'reorder_level' => 7, 'unit_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 1, 'name' => 'Tomate Cherry', 'item_type' => 'ingredient', 'quantity' => 40, 'reorder_level' => 5, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 1, 'name' => 'Pechuga de Pollo Congelada', 'item_type' => 'ingredient', 'quantity' => 25, 'reorder_level' => 3, 'unit_id' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 1, 'name' => 'Manteca', 'item_type' => 'ingredient', 'quantity' => 100, 'reorder_level' => 10, 'unit_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 1, 'name' => 'Pescado', 'item_type' => 'ingredient', 'quantity' => 35, 'reorder_level' => 6, 'unit_id' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 1, 'name' => 'Miel', 'item_type' => 'ingredient', 'quantity' => 15, 'reorder_level' => 3, 'unit_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 2, 'name' => 'Mantequilla', 'item_type' => 'ingredient', 'quantity' => 80, 'reorder_level' => 10, 'unit_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 2, 'name' => 'Pimiento', 'item_type' => 'ingredient', 'quantity' => 50, 'reorder_level' => 5, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 2, 'name' => 'Almendras', 'item_type' => 'ingredient', 'quantity' => 60, 'reorder_level' => 7, 'unit_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 2, 'name' => 'Pan', 'item_type' => 'prepackaged', 'quantity' => 120, 'reorder_level' => 15, 'unit_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 2, 'name' => 'Aguacate', 'item_type' => 'ingredient', 'quantity' => 40, 'reorder_level' => 5, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 3, 'name' => 'Leche Condensada', 'item_type' => 'prepackaged', 'quantity' => 25, 'reorder_level' => 5, 'unit_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 3, 'name' => 'Café Instantáneo', 'item_type' => 'prepackaged', 'quantity' => 90, 'reorder_level' => 15, 'unit_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 3, 'name' => 'Soda', 'item_type' => 'prepackaged', 'quantity' => 200, 'reorder_level' => 25, 'unit_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 3, 'name' => 'Té', 'item_type' => 'prepackaged', 'quantity' => 50, 'reorder_level' => 10, 'unit_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 3, 'name' => 'Frutos Secos', 'item_type' => 'prepackaged', 'quantity' => 30, 'reorder_level' => 5, 'unit_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 4, 'name' => 'Galletas Saladas', 'item_type' => 'prepackaged', 'quantity' => 100, 'reorder_level' => 15, 'unit_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 4, 'name' => 'Sopa Instantánea', 'item_type' => 'prepackaged', 'quantity' => 150, 'reorder_level' => 20, 'unit_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 4, 'name' => 'Gelatina', 'item_type' => 'prepackaged', 'quantity' => 90, 'reorder_level' => 15, 'unit_id' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 4, 'name' => 'Café Molido', 'item_type' => 'prepackaged', 'quantity' => 70, 'reorder_level' => 10, 'unit_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 4, 'name' => 'Fruta Deshidratada', 'item_type' => 'prepackaged', 'quantity' => 50, 'reorder_level' => 8, 'unit_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 5, 'name' => 'Frijoles', 'item_type' => 'ingredient', 'quantity' => 130, 'reorder_level' => 20, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 5, 'name' => 'Lentejas', 'item_type' => 'ingredient', 'quantity' => 90, 'reorder_level' => 15, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 5, 'name' => 'Quinoa', 'item_type' => 'ingredient', 'quantity' => 40, 'reorder_level' => 5, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 5, 'name' => 'Acelga', 'item_type' => 'ingredient', 'quantity' => 60, 'reorder_level' => 10, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 5, 'name' => 'Pepino', 'item_type' => 'ingredient', 'quantity' => 100, 'reorder_level' => 15, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 1, 'name' => 'Pistachos', 'item_type' => 'ingredient', 'quantity' => 40, 'reorder_level' => 5, 'unit_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 1, 'name' => 'Frambuesas', 'item_type' => 'ingredient', 'quantity' => 50, 'reorder_level' => 7, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 1, 'name' => 'Cúrcuma', 'item_type' => 'ingredient', 'quantity' => 60, 'reorder_level' => 10, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 1, 'name' => 'Pechuga de Pollo Fresca', 'item_type' => 'ingredient', 'quantity' => 80, 'reorder_level' => 12, 'unit_id' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 1, 'name' => 'Berenjena', 'item_type' => 'ingredient', 'quantity' => 70, 'reorder_level' => 10, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 2, 'name' => 'Kiwis', 'item_type' => 'ingredient', 'quantity' => 50, 'reorder_level' => 5, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 2, 'name' => 'Huevo', 'item_type' => 'ingredient', 'quantity' => 90, 'reorder_level' => 12, 'unit_id' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['supplier_id' => 2, 'name' => 'Tomates Secos', 'item_type' => 'ingredient', 'quantity' => 30, 'reorder_level' => 4, 'unit_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
