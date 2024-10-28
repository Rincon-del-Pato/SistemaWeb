<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('categories')->insert([
            [
                'name' => 'Entradas',
                'description' => 'Platos ligeros para comenzar la comida, a base de mariscos, pescados y otros ingredientes.',
            ],
            [
                'name' => 'Pescados y Mariscos',
                'description' => 'Platos principales de pescados y mariscos frescos según la temporada.',
            ],
            [
                'name' => 'Jaleas',
                'description' => 'Platos fritos de pescados y mariscos acompañados de zarza criolla.',
            ],
            [
                'name' => 'Chicharrones',
                'description' => 'Platos crujientes de pescados, langostinos y pulpo fritos.',
            ],
            [
                'name' => 'Platos de la casa',
                'description' => 'Especialidades tradicionales de la casa, con pato y cabrito.',
            ],
            [
                'name' => 'Tacu tacu',
                'description' => 'Platos a base de tacu tacu (mezcla de frijoles y arroz) acompañados de carnes o mariscos.',
            ],
            [
                'name' => 'Sopas',
                'description' => 'Sopas nutritivas y tradicionales para cualquier ocasión.',
            ],
            [
                'name' => 'Refrescos',
                'description' => 'Bebidas naturales y refrescantes para acompañar los platos.',
            ],
        ]);
    }
}