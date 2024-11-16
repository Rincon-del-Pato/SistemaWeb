<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InventoryLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('inventory_log')->insert([
            ['inventory_item_id' => 1, 'change_type' => 'Adición', 'quantity_change' => 50, 'change_date' => Carbon::now(), 'notes' => 'Se agregaron 50 unidades de Harina al inventario'],
            ['inventory_item_id' => 2, 'change_type' => 'Adición', 'quantity_change' => 30, 'change_date' => Carbon::now(), 'notes' => 'Se agregaron 30 unidades de Azúcar al inventario'],
            ['inventory_item_id' => 3, 'change_type' => 'Disminuir', 'quantity_change' => -20, 'change_date' => Carbon::now(), 'notes' => 'Se usaron 20 unidades de Aceite de Oliva en la producción'],
            ['inventory_item_id' => 4, 'change_type' => 'Adición', 'quantity_change' => 100, 'change_date' => Carbon::now(), 'notes' => 'Se agregaron 100 unidades de Sal al inventario'],
            ['inventory_item_id' => 5, 'change_type' => 'Disminuir', 'quantity_change' => -80, 'change_date' => Carbon::now(), 'notes' => 'Se usaron 80 unidades de Leche en la producción'],
            ['inventory_item_id' => 6, 'change_type' => 'Adición', 'quantity_change' => 60, 'change_date' => Carbon::now(), 'notes' => 'Se agregaron 60 unidades de Pechuga de Pollo al inventario'],
            ['inventory_item_id' => 7, 'change_type' => 'Disminuir', 'quantity_change' => -50, 'change_date' => Carbon::now(), 'notes' => 'Se usaron 50 unidades de Tomate en la producción'],
            ['inventory_item_id' => 8, 'change_type' => 'Adición', 'quantity_change' => 120, 'change_date' => Carbon::now(), 'notes' => 'Se agregaron 120 unidades de Papas al inventario'],
            ['inventory_item_id' => 9, 'change_type' => 'Disminuir', 'quantity_change' => -70, 'change_date' => Carbon::now(), 'notes' => 'Se usaron 70 unidades de Cebolla en la producción'],
            ['inventory_item_id' => 10, 'change_type' => 'Adición', 'quantity_change' => 30, 'change_date' => Carbon::now(), 'notes' => 'Se agregaron 30 unidades de Ajo al inventario'],
            ['inventory_item_id' => 11, 'change_type' => 'Disminuir', 'quantity_change' => -100, 'change_date' => Carbon::now(), 'notes' => 'Se usaron 100 unidades de Cereal en la producción'],
            ['inventory_item_id' => 12, 'change_type' => 'Adición', 'quantity_change' => 200, 'change_date' => Carbon::now(), 'notes' => 'Se agregaron 200 unidades de Galletas al inventario'],
            ['inventory_item_id' => 13, 'change_type' => 'Disminuir', 'quantity_change' => -50, 'change_date' => Carbon::now(), 'notes' => 'Se usaron 50 unidades de Chocolate en la producción'],
            ['inventory_item_id' => 14, 'change_type' => 'Adición', 'quantity_change' => 60, 'change_date' => Carbon::now(), 'notes' => 'Se agregaron 60 unidades de Leche en Polvo al inventario'],
            ['inventory_item_id' => 15, 'change_type' => 'Disminuir', 'quantity_change' => -30, 'change_date' => Carbon::now(), 'notes' => 'Se usaron 30 unidades de Jugo de Naranja en la producción'],
            ['inventory_item_id' => 16, 'change_type' => 'Adición', 'quantity_change' => 40, 'change_date' => Carbon::now(), 'notes' => 'Se agregaron 40 unidades de Salsa de Tomate al inventario'],
            ['inventory_item_id' => 17, 'change_type' => 'Disminuir', 'quantity_change' => -120, 'change_date' => Carbon::now(), 'notes' => 'Se usaron 120 unidades de Pasta en la producción'],
            ['inventory_item_id' => 18, 'change_type' => 'Adición', 'quantity_change' => 90, 'change_date' => Carbon::now(), 'notes' => 'Se agregaron 90 unidades de Arroz al inventario'],
            ['inventory_item_id' => 19, 'change_type' => 'Disminuir', 'quantity_change' => -40, 'change_date' => Carbon::now(), 'notes' => 'Se usaron 40 unidades de Mayonesa en la producción'],
            ['inventory_item_id' => 20, 'change_type' => 'Adición', 'quantity_change' => 50, 'change_date' => Carbon::now(), 'notes' => 'Se agregaron 50 unidades de Ketchup al inventario'],
            ['inventory_item_id' => 21, 'change_type' => 'Disminuir', 'quantity_change' => -60, 'change_date' => Carbon::now(), 'notes' => 'Se usaron 60 unidades de Pechuga de Pavo en la producción'],
            ['inventory_item_id' => 22, 'change_type' => 'Adición', 'quantity_change' => 80, 'change_date' => Carbon::now(), 'notes' => 'Se agregaron 80 unidades de Zanahoria al inventario'],
            ['inventory_item_id' => 23, 'change_type' => 'Disminuir', 'quantity_change' => -30, 'change_date' => Carbon::now(), 'notes' => 'Se usaron 30 unidades de Espinaca en la producción'],
            ['inventory_item_id' => 24, 'change_type' => 'Adición', 'quantity_change' => 90, 'change_date' => Carbon::now(), 'notes' => 'Se agregaron 90 unidades de Queso al inventario'],
            ['inventory_item_id' => 25, 'change_type' => 'Disminuir', 'quantity_change' => -20, 'change_date' => Carbon::now(), 'notes' => 'Se usaron 20 unidades de Yogur en la producción'],
            ['inventory_item_id' => 26, 'change_type' => 'Adición', 'quantity_change' => 50, 'change_date' => Carbon::now(), 'notes' => 'Se agregaron 50 unidades de Tomate Cherry al inventario'],
            ['inventory_item_id' => 27, 'change_type' => 'Disminuir', 'quantity_change' => -100, 'change_date' => Carbon::now(), 'notes' => 'Se usaron 100 unidades de Manteca en la producción'],
            ['inventory_item_id' => 28, 'change_type' => 'Adición', 'quantity_change' => 150, 'change_date' => Carbon::now(), 'notes' => 'Se agregaron 150 unidades de Pescado al inventario'],
            ['inventory_item_id' => 29, 'change_type' => 'Disminuir', 'quantity_change' => -200, 'change_date' => Carbon::now(), 'notes' => 'Se usaron 200 unidades de Miel en la producción'],
            ['inventory_item_id' => 30, 'change_type' => 'Adición', 'quantity_change' => 300, 'change_date' => Carbon::now(), 'notes' => 'Se agregaron 300 unidades de Pechuga de Pollo Fresca al inventario'],
        ]);
    }
}
