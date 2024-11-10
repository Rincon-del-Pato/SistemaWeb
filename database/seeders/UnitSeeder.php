<?php

namespace Database\Seeders;

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
            ['unit_name' => 'gramos', 'abbreviation' => 'g', 'description' => 'Unidad de peso en gramos'],
            ['unit_name' => 'mililitros', 'abbreviation' => 'ml', 'description' => 'Unidad de volumen en mililitros'],
            ['unit_name' => 'unidades', 'abbreviation' => 'u', 'description' => 'Unidad de conteo individual'],
        ]);
    }
}
