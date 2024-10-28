<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('sizes')->insert([
            // Entradas (category_id = 1)
            [
                'type' => 'Unico',
                'price' => 4.00,
                'status' => 'Oculto',
            ],
            [
                'type' => 'Unico',
                'price' => 20.00,
                'status' => 'Oculto',
            ],
            [
                'type' => 'Unico',
                'price' => 20.00,
                'status' => 'Oculto',
            ],
            // Pescados y Mariscos (category_id = 2)
            [
                'type' => 'Unico',
                'price' => 25.00, // Precio temporal
                'status' => 'Oculto',
            ],
            [
                'type' => 'Unico',
                'price' => 30.00, // Precio temporal
                'status' => 'Oculto',
            ],
            // Jaleas (category_id = 3)
            [
                'type' => 'Personal',
                'price' => 28.00, // Precio temporal
                'status' => 'Disponible',
            ],
            [
                'type' => 'Fuente',
                'price' => 55.00, // Precio temporal
                'status' => 'Disponible',
            ],
            // Chicharrones (category_id = 4)
            [
                'type' => 'Unico',
                'price' => 20.00,
                'status' => 'Oculto',
            ],
            [
                'type' => 'Unico',
                'price' => 25.00,
                'status' => 'Oculto',
            ],
            // Platos de la casa (category_id = 5)
            [
                'type' => 'Unico',
                'price' => 22.00,
                'status' => 'Oculto',
            ],
            [
                'type' => 'Unico',
                'price' => 22.00,
                'status' => 'Oculto',
            ],
            // Tacu tacu (category_id = 6)
            [
                'type' => 'Unico',
                'price' => 26.00,
                'status' => 'Oculto',
            ],
            [
                'type' => 'Unico',
                'price' => 22.00,
                'status' => 'Oculto',
            ],
            // Sopas (category_id = 7)
            [
                'type' => 'Unico',
                'price' => 10.00,
                'status' => 'Oculto',
            ],
            [
                'type' => 'Unico',
                'price' => 10.00,
                'status' => 'Oculto',
            ],
            // Refrescos (category_id = 8)
            [
                'type' => 'Unico',
                'price' => 10.00,
                'status' => 'Oculto',
            ],
            [
                'type' => 'Unico',
                'price' => 10.00,
                'status' => 'Oculto',
            ],
        ]);
    }
}
