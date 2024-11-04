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
            [
                'name' => 'Mesa 1',
                'capacity' => 4,
                'status' => 'Disponible',
            ],
            [
                'name' => 'Mesa 2',
                'capacity' => 4,
                'status' => 'Disponible',
            ],
            [
                'name' => 'Mesa 3',
                'capacity' => 4,
                'status' => 'Disponible',
            ],
            [
                'name' => 'Mesa 4',
                'capacity' => 4,
                'status' => 'Disponible',
            ],
            [
                'name' => 'Mesa 5',
                'capacity' => 6,
                'status' => 'Disponible',
            ],
            [
                'name' => 'Mesa 6',
                'capacity' => 6,
                'status' => 'Disponible',
            ],
            [
                'name' => 'Mesa 7',
                'capacity' => 6,
                'status' => 'Disponible',
            ],
            [
                'name' => 'Mesa 8',
                'capacity' => 8,
                'status' => 'Disponible',
            ],
            [
                'name' => 'Mesa 9',
                'capacity' => 8,
                'status' => 'Disponible',
            ],
            [
                'name' => 'Mesa 10',
                'capacity' => 8,
                'status' => 'Disponible',
            ]
        ]);
    }
}
