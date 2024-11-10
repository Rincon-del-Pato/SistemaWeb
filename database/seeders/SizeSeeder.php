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
            ['size_name' => 'Personal', 'description' => 'Porción personal'],
            ['size_name' => 'Fuente', 'description' => 'Porción para compartir']
        ]);
    }
}
