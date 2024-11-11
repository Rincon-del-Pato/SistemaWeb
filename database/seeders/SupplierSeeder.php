<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
            [
                'name' => 'Distribuidora Gourmet',
                'contact_name' => 'Carlos Rivas',
                'phone' => '555-1010',
                'email' => 'carlos@gourmet.com',
                'address' => 'Av. Principal 123, Ciudad A',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Frescos del Campo',
                'contact_name' => 'Ana Beltrán',
                'phone' => '555-2020',
                'email' => 'ana@frescoscampo.com',
                'address' => 'Calle Verde 456, Ciudad B',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Carnes Selectas',
                'contact_name' => 'Miguel Díaz',
                'phone' => '555-3030',
                'email' => 'miguel@carnesselectas.com',
                'address' => 'Av. Norte 789, Ciudad C',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Lácteos del Sur',
                'contact_name' => 'Laura González',
                'phone' => '555-4040',
                'email' => 'laura@lacteossur.com',
                'address' => 'Calle Central 101, Ciudad D',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bebidas Premium',
                'contact_name' => 'Raúl Márquez',
                'phone' => '555-5050',
                'email' => 'raul@bebidaspremium.com',
                'address' => 'Av. Oeste 202, Ciudad E',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
