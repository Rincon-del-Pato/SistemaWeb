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
            ['name' => 'Jaleas del Norte', 'description' => 'Jaleas típicas del norte de Perú, con pescado y mariscos'],
            ['name' => 'Conchas Negras', 'description' => 'Platos elaborados con conchas negras frescas'],
            ['name' => 'Tortillas Varias', 'description' => 'Tortillas hechas con yuyo, raya, mariscos y más ingredientes locales'],
            ['name' => 'Otros Típicos', 'description' => 'Platos tradicionales de la región, como seco de chabelo y batea en zarza'],
            ['name' => 'Pescado', 'description' => 'Platos a base de pescado fresco como cebiches y causas'],
            ['name' => 'Pato', 'description' => 'Platos elaborados con pato, una especialidad del restaurante'],
            ['name' => 'Entradas', 'description' => 'Entradas típicas como cebiches y tortillas'],
            ['name' => 'Segundos', 'description' => 'Platos principales variados con carne, pato y otros ingredientes'],
            ['name' => 'Sopas', 'description' => 'Sopas criollas y tradicionales de la región'],
            ['name' => 'Chupes', 'description' => 'Platos de chupe de pescado y otros mariscos'],
            ['name' => 'Postres', 'description' => 'Postres tradicionales como quesillo y dulces de higos'],
            ['name' => 'Refrescos', 'description' => 'Bebidas refrescantes como chicha morada y limonada']
        ]);
    }
}
