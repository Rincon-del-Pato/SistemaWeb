<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('menu_items')->insert([
            // Jaleas del Norte
            ['category_id' => 1, 'name' => 'Jalea de Pescado', 'description' => 'Jalea de pescado fresco con yuca y salsa criolla'],
            ['category_id' => 1, 'name' => 'Jalea Mixta', 'description' => 'Jalea de pescado y mariscos'],
            ['category_id' => 1, 'name' => 'Jalea de Ojo de Uva', 'description' => 'Jalea especial con pescado ojo de uva'],
            ['category_id' => 1, 'name' => 'Jalea de Robalo', 'description' => 'Jalea de robalo fresco'],
            ['category_id' => 1, 'name' => 'Jalea de Mero o Lenguado', 'description' => 'Jalea de mero o lenguado con salsas especiales'],

            // Conchas Negras
            ['category_id' => 2, 'name' => 'Sudado de Conchas Negras', 'description' => 'Sudado de conchas negras con especias'],
            ['category_id' => 2, 'name' => 'Cebiche de Conchas Negras', 'description' => 'Cebiche de conchas negras frescas'],
            ['category_id' => 2, 'name' => 'Cebiche de Pescado con Conchas Negras', 'description' => 'Cebiche mixto con pescado y conchas negras'],
            ['category_id' => 2, 'name' => 'Arroz con Mariscos y Conchas Negras', 'description' => 'Arroz de mariscos con conchas negras'],
            ['category_id' => 2, 'name' => 'Arroz con Conchas Negras', 'description' => 'Arroz tradicional con conchas negras'],

            // Tortillas Varias
            ['category_id' => 3, 'name' => 'Tortilla de Yuyo', 'description' => 'Tortilla a base de yuyo fresco'],
            ['category_id' => 3, 'name' => 'Tortilla de Raya', 'description' => 'Tortilla preparada con raya'],
            ['category_id' => 3, 'name' => 'Tortilla de Mariscos', 'description' => 'Tortilla de mariscos variados'],
            ['category_id' => 3, 'name' => 'Omelet de Mariscos', 'description' => 'Omelet relleno de mariscos'],
            ['category_id' => 3, 'name' => 'Tortilla de Langostinos', 'description' => 'Tortilla especial de langostinos'],

            // Otros Típicos
            ['category_id' => 4, 'name' => 'Langoraya', 'description' => 'Langoraya hecha con langostino y raya'],
            ['category_id' => 4, 'name' => 'Majadito de Yuca con Carne Seca', 'description' => 'Yuca majada con carne seca piurana'],
            ['category_id' => 4, 'name' => 'Seco de Chabelo', 'description' => 'Seco de carne tradicional Piurana'],
            ['category_id' => 4, 'name' => 'Batea en Zarza', 'description' => 'Batea en zarza, especialidad regional'],
            ['category_id' => 4, 'name' => 'Causa Norteña Pescado', 'description' => 'Causa norteña con pescado fresco'],

            // Entradas
            ['category_id' => 5, 'name' => 'Cebiche Maternal', 'description' => 'Cebiche maternal con limón y ají'],
            ['category_id' => 5, 'name' => 'Cebiche de Caballa', 'description' => 'Cebiche de caballa con especias'],
            ['category_id' => 5, 'name' => 'Cebiche Exótico en el Rincón', 'description' => 'Cebiche especial de la casa'],
            ['category_id' => 5, 'name' => 'Causa de Pescado y Otros', 'description' => 'Causa con pescado y otros ingredientes'],

            // Pato
            ['category_id' => 6, 'name' => 'Arroz con Pato', 'description' => 'Arroz con pato sazonado'],
            ['category_id' => 6, 'name' => 'Pato Arvejado', 'description' => 'Pato en salsa de arvejas'],
            ['category_id' => 6, 'name' => 'Pato Entomatado', 'description' => 'Pato cocinado con tomate fresco'],
            ['category_id' => 6, 'name' => 'Cebiche de Pato', 'description' => 'Cebiche de pato con especias'],

            // Sopas
            ['category_id' => 7, 'name' => 'Sopa a la Criolla', 'description' => 'Sopa criolla de carne con fideos'],
            ['category_id' => 7, 'name' => 'Sopa a la Minuta', 'description' => 'Sopa rápida a base de carne y vegetales'],

            // Chupes
            ['category_id' => 8, 'name' => 'Chupe de Pescado', 'description' => 'Chupe cremoso de pescado con papas y queso'],
            ['category_id' => 8, 'name' => 'Chupe de Robalo', 'description' => 'Chupe especial de robalo'],

            // Postres
            ['category_id' => 9, 'name' => 'Quesillo con Miel de Caña', 'description' => 'Postre con quesillo y miel de caña'],
            ['category_id' => 9, 'name' => 'Dulce de Higos', 'description' => 'Dulce a base de higos frescos'],

            // Refrescos
            ['category_id' => 10, 'name' => 'Chicha Morada', 'description' => 'Refresco tradicional de maíz morado'],
            ['category_id' => 10, 'name' => 'Limonada', 'description' => 'Limonada fresca']
        ]);
    }
}
