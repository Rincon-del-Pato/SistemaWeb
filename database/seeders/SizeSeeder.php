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
        DB::table('sizes')->insert([
            [
                'size_name' => 'Pequeño',
                'description' => 'Tamaño pequeño',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'size_name' => 'Mediano',
                'description' => 'Tamaño mediano',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'size_name' => 'Grande',
                'description' => 'Tamaño grande',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
