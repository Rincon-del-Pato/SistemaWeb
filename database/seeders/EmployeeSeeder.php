<?php

namespace Database\Seeders;

use App\Models\Employees;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('employees')->insert([
            [
                'lastname' => 'Silva Muñoz',
                'dni' => '76547890',
                'age' => '23',
                'phone' => '987456231',
                'address' => 'Calle',
                'city' => 'Guadalupe',
                'user_id' => 2,
            ],
            [
                'lastname' => 'Becerra Linares',
                'dni' => '87905643',
                'age' => '25',
                'phone' => '954548006',
                'address' => 'Calle',
                'city' => 'Guadalupe',
                'user_id' => 3,
            ],
            [
                'lastname' => 'Suarez Chimoy',
                'dni' => '87652398',
                'age' => '24',
                'phone' => '965238976',
                'address' => 'Calle',
                'city' => 'Guadalupe',
                'user_id' => 4,
            ]
        ]);

    }
}
