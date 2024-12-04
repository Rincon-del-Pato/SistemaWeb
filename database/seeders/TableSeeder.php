<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
            ['table_number' => '01', 'seating_capacity' => 4, 'status' => 'Ocupado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['table_number' => '02', 'seating_capacity' => 2, 'status' => 'Disponible', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['table_number' => '03', 'seating_capacity' => 4, 'status' => 'Disponible', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['table_number' => '04', 'seating_capacity' => 6, 'status' => 'Disponible', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['table_number' => '05', 'seating_capacity' => 4, 'status' => 'Disponible', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['table_number' => '06', 'seating_capacity' => 2, 'status' => 'Disponible', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['table_number' => '07', 'seating_capacity' => 4, 'status' => 'Disponible', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['table_number' => '08', 'seating_capacity' => 6, 'status' => 'Disponible', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['table_number' => '09', 'seating_capacity' => 4, 'status' => 'Disponible', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['table_number' => '10', 'seating_capacity' => 2, 'status' => 'Ocupado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['table_number' => '11', 'seating_capacity' => 4, 'status' => 'Disponible', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['table_number' => '12', 'seating_capacity' => 6, 'status' => 'Disponible', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['table_number' => '13', 'seating_capacity' => 4, 'status' => 'Disponible', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['table_number' => '14', 'seating_capacity' => 2, 'status' => 'Disponible', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['table_number' => '15', 'seating_capacity' => 4, 'status' => 'Disponible', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['table_number' => '16', 'seating_capacity' => 6, 'status' => 'Disponible', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['table_number' => '17', 'seating_capacity' => 4, 'status' => 'Disponible', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['table_number' => '18', 'seating_capacity' => 2, 'status' => 'Disponible', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['table_number' => '19', 'seating_capacity' => 4, 'status' => 'Disponible', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['table_number' => '20', 'seating_capacity' => 6, 'status' => 'Disponible', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
        ]);
    }
}
