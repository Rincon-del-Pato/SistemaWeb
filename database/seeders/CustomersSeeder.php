<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('customers')->insert([
            ['name' => 'Juan Pérez', 'email' => 'juan.perez@example.com', 'phone' => '987654321'],
            ['name' => 'María García', 'email' => 'maria.garcia@example.com', 'phone' => '123456789'],
            ['name' => 'Carlos Ramírez', 'email' => null, 'phone' => '555444333'], // Cliente sin email
            ['name' => 'Ana Torres', 'email' => 'ana.torres@example.com', 'phone' => '111222333'],
            ['name' => 'Pedro Sánchez', 'email' => 'pedro.sanchez@example.com', 'phone' => '999888777'],
            ['name' => 'Gabriela Gómez', 'email' => null, 'phone' => '666777888'], // Cliente sin email
            ['name' => 'Andrés Flores', 'email' => 'andres.flores@example.com', 'phone' => '444555666'],
            ['name' => 'Valeria Castillo', 'email' => 'valeria.castillo@example.com', 'phone' => '333222111'],
            ['name' => 'Mario Gutiérrez', 'email' => 'mario.gutierrez@example.com', 'phone' => '777888999'],
            ['name' => 'Sandra Ruiz', 'email' => 'sandra.ruiz@example.com', 'phone' => '222333444'],
            ['name' => 'Fernando Luna', 'email' => null, 'phone' => '123123123'], // Cliente sin email
            ['name' => 'Lucía Prieto', 'email' => 'lucia.prieto@example.com', 'phone' => '321321321'],
            ['name' => 'Diego López', 'email' => 'diego.lopez@example.com', 'phone' => '987987987'],
            ['name' => 'Paola Méndez', 'email' => null, 'phone' => '654654654'], // Cliente sin email
            ['name' => 'Javier Ortega', 'email' => 'javier.ortega@example.com', 'phone' => '789789789'],
            ['name' => 'Claudia Morales', 'email' => 'claudia.morales@example.com', 'phone' => '456456456'],
            ['name' => 'Alonso Vega', 'email' => 'alonso.vega@example.com', 'phone' => '159753486'],
            ['name' => 'Rosa Martínez', 'email' => 'rosa.martinez@example.com', 'phone' => '852963741'],
            ['name' => 'Luis Castro', 'email' => 'luis.castro@example.com', 'phone' => '963852741'],
            ['name' => 'Marta Campos', 'email' => 'marta.campos@example.com', 'phone' => '741852963'],
        ]);
    }
}
