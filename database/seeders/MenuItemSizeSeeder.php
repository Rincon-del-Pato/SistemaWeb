<?php

namespace Database\Seeders;

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
            // Ejemplos de Jaleas
            ['menu_item_id' => 1, 'size_id' => 1, 'price' => 28.00], // Jalea de Pescado - Personal
            ['menu_item_id' => 1, 'size_id' => 2, 'price' => 55.00], // Jalea de Pescado - Fuente

            ['menu_item_id' => 2, 'size_id' => 1, 'price' => 31.00], // Jalea Mixta - Personal
            ['menu_item_id' => 2, 'size_id' => 2, 'price' => 60.00], // Jalea Mixta - Fuente

            // Ejemplos de Conchas Negras
            ['menu_item_id' => 6, 'size_id' => 1, 'price' => 28.00], // Sudado de Conchas Negras - Personal
            ['menu_item_id' => 6, 'size_id' => 2, 'price' => 56.00], // Sudado de Conchas Negras - Fuente

            // Ejemplos de Tortillas
            ['menu_item_id' => 13, 'size_id' => 1, 'price' => 15.00], // Tortilla de Yuyo - Personal
            ['menu_item_id' => 13, 'size_id' => 2, 'price' => 28.00], // Tortilla de Yuyo - Fuente

            // Ejemplos de Pato
            ['menu_item_id' => 25, 'size_id' => 1, 'price' => 26.00], // Arroz con Pato - Personal
            ['menu_item_id' => 25, 'size_id' => 2, 'price' => 50.00], // Arroz con Pato - Fuente

            // Ejemplos de Refrescos (solo un tamaño)
            ['menu_item_id' => 35, 'size_id' => 1, 'price' => 12.00], // Chicha Morada
            ['menu_item_id' => 36, 'size_id' => 1, 'price' => 7.50],  // Limonada
        ]);
    }
}
