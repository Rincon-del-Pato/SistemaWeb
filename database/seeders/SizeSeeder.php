<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // DB::table('sizes')->insert([
        //     [
        //         'size_name' => 'Pequeño',
        //         'description' => 'Tamaño pequeño',
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ],
        //     [
        //         'size_name' => 'Mediano',
        //         'description' => 'Tamaño mediano',
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ],
        //     [
        //         'size_name' => 'Grande',
        //         'description' => 'Tamaño grande',
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ],
        // ]);
        DB::table('sizes')->insert([
            [
                'size_name' => 'Personal',
                'description' => 'Tamaño para una persona',
                'volume' => null,
                'unit_id' => null,
                // 'volume' => 1.00,
                // 'unit_id' => 6, // 'Unidades'
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'size_name' => 'Fuente',
                'description' => 'Tamaño para servir varios platos',
                'volume' => null,
                'unit_id' => null,
                // 'volume' => 3.00,
                // 'unit_id' => 6, // 'Unidades'
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'size_name' => 'Bebida Pequeña',
                'description' => 'Tamaño pequeño para bebidas',
                'volume' => 250,
                'unit_id' => 5, // 'Mililitros'
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'size_name' => 'Bebida Mediana',
                'description' => 'Tamaño mediano para bebidas',
                'volume' => 500,
                'unit_id' => 5, // 'Mililitros'
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'size_name' => 'Bebida Grande',
                'description' => 'Tamaño grande para bebidas',
                'volume' => 1,
                'unit_id' => 4, // 'Litros'
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'size_name' => 'Pequeño',
                'description' => 'Tamaño pequeño genérico',
                'volume' => null,
                'unit_id' => null,
                // 'volume' => 1.00,
                // 'unit_id' => 6, // 'Unidades'
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'size_name' => 'Mediano',
                'description' => 'Tamaño mediano genérico',
                'volume' => null,
                'unit_id' => null,
                // 'volume' => 2.00,
                // 'unit_id' => 6, // 'Unidades'
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'size_name' => 'Grande',
                'description' => 'Tamaño grande genérico',
                'volume' => null,
                'unit_id' => null,
                // 'volume' => 3.00,
                // 'unit_id' => 6, // 'Unidades'
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

    }
}
