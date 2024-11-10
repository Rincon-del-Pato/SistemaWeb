<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('suppliers')->insert([
            ['name' => 'Proveedor Marítimo', 'contact_name' => 'Carlos Pérez', 'phone' => '123456789', 'email' => 'maritimo@example.com', 'address' => 'Av. Marítima 123'],
            ['name' => 'Carnes y más', 'contact_name' => 'Lucía Rojas', 'phone' => '987654321', 'email' => 'carnesymas@example.com', 'address' => 'Calle Firme 456'],
            ['name' => 'VeggiePro', 'contact_name' => 'Jorge Vega', 'phone' => '555666777', 'email' => 'veggiepro@example.com', 'address' => 'Av. Saludable 789'],
            ['name' => 'Lácteos del Valle', 'contact_name' => 'Ana Gómez', 'phone' => '333444555', 'email' => 'lacteosvalle@example.com', 'address' => 'Calle Queso 321'],
            ['name' => 'Especias y Sabores', 'contact_name' => 'Raúl Castro', 'phone' => '222111000', 'email' => 'especias@example.com', 'address' => 'Av. Aroma 654'],
            ['name' => 'Panadería Central', 'contact_name' => 'Martín Fuentes', 'phone' => '666777888', 'email' => 'panaderiacentral@example.com', 'address' => 'Av. Panadero 101'],
            ['name' => 'Bebidas Tropicales', 'contact_name' => 'Gabriela Sánchez', 'phone' => '111222333', 'email' => 'bebidastropicales@example.com', 'address' => 'Calle Refresco 909'],
        ]);
    }
}
