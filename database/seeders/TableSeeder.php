<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('tables')->insert([
            ['table_number' => '1', 'seating_capacity' => 2, 'status' => 'Disponible', 'created_at' => now(), 'updated_at' => now()],
            ['table_number' => '2', 'seating_capacity' => 4, 'status' => 'Ocupado', 'created_at' => now(), 'updated_at' => now()],
            ['table_number' => '3', 'seating_capacity' => 6, 'status' => 'Reservado', 'created_at' => now(), 'updated_at' => now()],
            ['table_number' => '4', 'seating_capacity' => 4, 'status' => 'Disponible', 'created_at' => now(), 'updated_at' => now()],
            ['table_number' => '5', 'seating_capacity' => 2, 'status' => 'Disponible', 'created_at' => now(), 'updated_at' => now()],
            ['table_number' => '6', 'seating_capacity' => 8, 'status' => 'Ocupado', 'created_at' => now(), 'updated_at' => now()],
            ['table_number' => '7', 'seating_capacity' => 4, 'status' => 'Reservado', 'created_at' => now(), 'updated_at' => now()],
            ['table_number' => '8', 'seating_capacity' => 6, 'status' => 'Disponible', 'created_at' => now(), 'updated_at' => now()],
            ['table_number' => '9', 'seating_capacity' => 2, 'status' => 'Ocupado', 'created_at' => now(), 'updated_at' => now()],
            ['table_number' => '10', 'seating_capacity' => 4, 'status' => 'Disponible', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
