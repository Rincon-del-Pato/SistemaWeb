<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('units')->insert([
            [
                'unit_name' => 'Kilogramos',
                'abbreviation' => 'kg',
                'description' => 'Unidad de medida para productos por peso',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'unit_name' => 'Litros',
                'abbreviation' => 'L',
                'description' => 'Unidad de medida para productos líquidos',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'unit_name' => 'Unidades',
                'abbreviation' => 'unid',
                'description' => 'Unidad de medida para productos individuales',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'unit_name' => 'Cajas',
                'abbreviation' => 'caja',
                'description' => 'Unidad de medida para productos empaquetados en cajas',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'unit_name' => 'Gramos',
                'abbreviation' => 'g',
                'description' => 'Unidad de medida para pequeñas cantidades de peso',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
