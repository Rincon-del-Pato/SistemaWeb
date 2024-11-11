<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
            ['name' => 'Carlos García', 'email' => 'carlos.garcia@example.com', 'phone' => '987654321', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Ana López', 'email' => 'ana.lopez@example.com', 'phone' => '912345678', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Luis Rodríguez', 'email' => 'luis.rodriguez@example.com', 'phone' => '913456789', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'María Pérez', 'email' => 'maria.perez@example.com', 'phone' => '914567890', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Javier Martínez', 'email' => 'javier.martinez@example.com', 'phone' => '915678901', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Laura González', 'email' => 'laura.gonzalez@example.com', 'phone' => '916789012', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Pedro Sánchez', 'email' => 'pedro.sanchez@example.com', 'phone' => '917890123', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Lucía Fernández', 'email' => 'lucia.fernandez@example.com', 'phone' => '918901234', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'José Díaz', 'email' => 'jose.diaz@example.com', 'phone' => '919012345', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Elena Pérez', 'email' => 'elena.perez@example.com', 'phone' => '920123456', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Francisco Martínez', 'email' => 'francisco.martinez@example.com', 'phone' => '921234567', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Marta Sánchez', 'email' => 'marta.sanchez@example.com', 'phone' => '922345678', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'David González', 'email' => 'david.gonzalez@example.com', 'phone' => '923456789', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Sofia Rodríguez', 'email' => 'sofia.rodriguez@example.com', 'phone' => '924567890', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Miguel Gómez', 'email' => 'miguel.gomez@example.com', 'phone' => '925678901', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Carmen López', 'email' => 'carmen.lopez@example.com', 'phone' => '926789012', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Antonio Fernández', 'email' => 'antonio.fernandez@example.com', 'phone' => '927890123', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Isabel García', 'email' => 'isabel.garcia@example.com', 'phone' => '928901234', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Raúl Pérez', 'email' => 'raul.perez@example.com', 'phone' => '929012345', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Teresa Sánchez', 'email' => 'teresa.sanchez@example.com', 'phone' => '930123456', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Ricardo Rodríguez', 'email' => 'ricardo.rodriguez@example.com', 'phone' => '931234567', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Beatriz Díaz', 'email' => 'beatriz.diaz@example.com', 'phone' => '932345678', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Raquel González', 'email' => 'raquel.gonzalez@example.com', 'phone' => '933456789', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Eduardo Martínez', 'email' => 'eduardo.martinez@example.com', 'phone' => '934567890', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Verónica Pérez', 'email' => 'veronica.perez@example.com', 'phone' => '935678901', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Sergio Gómez', 'email' => 'sergio.gomez@example.com', 'phone' => '936789012', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Paula Rodríguez', 'email' => 'paula.rodriguez@example.com', 'phone' => '937890123', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Álvaro López', 'email' => 'alvaro.lopez@example.com', 'phone' => '938901234', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Victoria Sánchez', 'email' => 'victoria.sanchez@example.com', 'phone' => '939012345', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Tomás Fernández', 'email' => 'tomas.fernandez@example.com', 'phone' => '940123456', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Alicia Gómez', 'email' => 'alicia.gomez@example.com', 'phone' => '941234567', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Antonio López', 'email' => 'antonio.lopez@example.com', 'phone' => '942345678', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'María Rodríguez', 'email' => 'maria.rodriguez@example.com', 'phone' => '943456789', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'David Pérez', 'email' => 'david.perez@example.com', 'phone' => '944567890', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Juan Sánchez', 'email' => 'juan.sanchez@example.com', 'phone' => '945678901', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Mercedes Díaz', 'email' => 'mercedes.diaz@example.com', 'phone' => '946789012', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Jorge González', 'email' => 'jorge.gonzalez@example.com', 'phone' => '947890123', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Juliana Fernández', 'email' => 'juliana.fernandez@example.com', 'phone' => '948901234', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'José Luis Gómez', 'email' => 'joseluis.gomez@example.com', 'phone' => '949012345', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Juan Carlos Pérez', 'email' => 'juancarlos.perez@example.com', 'phone' => '950123456', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Raul López', 'email' => 'raul.lopez@example.com', 'phone' => '951234567', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Susana Sánchez', 'email' => 'susana.sanchez@example.com', 'phone' => '952345678', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Ignacio González', 'email' => 'ignacio.gonzalez@example.com', 'phone' => '953456789', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Patricia Rodríguez', 'email' => 'patricia.rodriguez@example.com', 'phone' => '954567890', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Juan Antonio Martínez', 'email' => 'juanantonio.martinez@example.com', 'phone' => '955678901', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Luis Fernando Pérez', 'email' => 'luisfernando.perez@example.com', 'phone' => '956789012', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Alberto Gómez', 'email' => 'alberto.gomez@example.com', 'phone' => '957890123', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Carlos Sánchez', 'email' => 'carlos.sanchez@example.com', 'phone' => '958901234', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Marcos Díaz', 'email' => 'marcos.diaz@example.com', 'phone' => '959012345', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Ana María González', 'email' => 'anamaria.gonzalez@example.com', 'phone' => '960123456', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'José Manuel Rodríguez', 'email' => 'josemanuel.rodriguez@example.com', 'phone' => '961234567', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Patricia Sánchez', 'email' => 'patricia.sanchez@example.com', 'phone' => '963456789', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Sandra Fernández', 'email' => 'sandra.fernandez@example.com', 'phone' => '964567890', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Carlos González', 'email' => 'carlos.gonzalez@example.com', 'phone' => '965678901', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Roberto Martínez', 'email' => 'roberto.martinez@example.com', 'phone' => '966789012', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Martín López', 'email' => 'martin.lopez@example.com', 'phone' => '967890123', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Antonio Díaz', 'email' => 'antonio.diaz@example.com', 'phone' => '968901234', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Adriana Rodríguez', 'email' => 'adriana.rodriguez@example.com', 'phone' => '969012345', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Santiago Gómez', 'email' => 'santiago.gomez@example.com', 'phone' => '970123456', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Juan Fernández', 'email' => 'juan.fernandez@example.com', 'phone' => '971234567', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Carlos Pérez', 'email' => 'carlos.perez@example.com', 'phone' => '972345678', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Rosa Sánchez', 'email' => 'rosa.sanchez@example.com', 'phone' => '973456789', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'María Teresa Díaz', 'email' => 'mariateresa.diaz@example.com', 'phone' => '974567890', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Victor Hugo González', 'email' => 'victorhugo.gonzalez@example.com', 'phone' => '975678901', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
