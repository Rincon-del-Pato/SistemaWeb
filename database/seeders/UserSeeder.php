<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            //Administracion
            $user =User::create([
                'name' => 'Jhosep',
                'email'    => 'admin@example.com',
                'password' => Hash::make('12345678'), // password

            ])->assignRole('gerente_general');

            $user =User::create([
                'name' => 'Jorge',
                'email'    => 'jorge@gmail.com',
                'password' => Hash::make('12345678'), // password

            ])->assignRole('gerente_ventas');

            $user =User::create([
                'name' => 'Juan',
                'email'    => 'chef@gmail.com',
                'password' => Hash::make('12345678'), // password

            ])->assignRole('cocinero');

            $user =User::create([
                'name' => 'José',
                'email'    => 'mesero@gmail.com',
                'password' => Hash::make('12345678'), // password

            ])->assignRole('mesero');

            $user =User::create([
                'name' => 'Julio',
                'email'    => 'asistentecosina1@gmail.com',
                'password' => Hash::make('12345678'), // password

            ])->assignRole('asistente_cosina');

            // $user =User::create([
            //     'name' => 'Jhosep',
            //     'email'    => 'asistentecosina1@example.com',
            //     'password' => Hash::make('12345678'), // password

            // ])->assignRole('admin');

            // $user =User::create([
            //     'name' => 'Jhosep',
            //     'email'    => 'admin@example.com',
            //     'password' => Hash::make('12345678'), // password

            // ])->assignRole('admin');

            // $user =User::create([
            //     'name' => 'Jhosep',
            //     'email'    => 'admin@example.com',
            //     'password' => Hash::make('12345678'), // password

            // ])->assignRole('admin');
    }
}
