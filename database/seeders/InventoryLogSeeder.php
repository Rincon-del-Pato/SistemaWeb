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
        // Solo crearemos logs para los ingredientes que sabemos que existen
        DB::table('inventory_log')->insert([
            // Logs para Ingredientes
            ['inventory_item_id' => 1, 'change_type' => 'Adición', 'quantity_change' => 50, 'change_date' => Carbon::now(), 'notes' => 'Abastecimiento inicial de Harina'],
            ['inventory_item_id' => 2, 'change_type' => 'Adición', 'quantity_change' => 30, 'change_date' => Carbon::now(), 'notes' => 'Abastecimiento inicial de Azúcar'],
            ['inventory_item_id' => 3, 'change_type' => 'Adición', 'quantity_change' => 20, 'change_date' => Carbon::now(), 'notes' => 'Abastecimiento inicial de Aceite de Oliva'],
            ['inventory_item_id' => 4, 'change_type' => 'Adición', 'quantity_change' => 100, 'change_date' => Carbon::now(), 'notes' => 'Abastecimiento inicial de Sal'],
            ['inventory_item_id' => 5, 'change_type' => 'Adición', 'quantity_change' => 80, 'change_date' => Carbon::now(), 'notes' => 'Abastecimiento inicial de Leche'],

            // Algunos movimientos de consumo
            ['inventory_item_id' => 1, 'change_type' => 'Disminuir', 'quantity_change' => 10, 'change_date' => Carbon::now()->addHours(1), 'notes' => 'Consumo en producción - Harina'],
            ['inventory_item_id' => 2, 'change_type' => 'Disminuir', 'quantity_change' => 5, 'change_date' => Carbon::now()->addHours(1), 'notes' => 'Consumo en producción - Azúcar'],

            // Logs para Productos Preenvasados
            ['inventory_item_id' => 18, 'change_type' => 'Adición', 'quantity_change' => 24, 'change_date' => Carbon::now(), 'notes' => 'Recepción inicial de Coca Cola'],
            ['inventory_item_id' => 19, 'change_type' => 'Adición', 'quantity_change' => 24, 'change_date' => Carbon::now(), 'notes' => 'Recepción inicial de Inca Kola'],
            ['inventory_item_id' => 20, 'change_type' => 'Adición', 'quantity_change' => 20, 'change_date' => Carbon::now(), 'notes' => 'Recepción inicial de Sprite'],

            // Algunos movimientos de venta de productos
            ['inventory_item_id' => 18, 'change_type' => 'Disminuir', 'quantity_change' => 2, 'change_date' => Carbon::now()->addHours(2), 'notes' => 'Venta de Coca Cola'],
            ['inventory_item_id' => 19, 'change_type' => 'Disminuir', 'quantity_change' => 3, 'change_date' => Carbon::now()->addHours(2), 'notes' => 'Venta de Inca Kola'],
        ]);
    }
}
