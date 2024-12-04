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
        $users = [
            [
                'name' => 'Admin',
                'email'    => 'admin@example.com',
                'password' => Hash::make('12345678'), // password
                'role' => 'gerente_general',
                'image_employee' => 'https://lh3.googleusercontent.com/d/1ljlsRh8me99UqbDUbEerdsRmd7Rm6cAS',
            ],
            [
                'name' => 'Luis Alberto',
                'email' => 'chef@gmail.com',
                'password' => Hash::make('chef1234'), // password
                'role' => 'cocinero',
                'image_employee' => 'https://lh3.googleusercontent.com/d/1e4QmKrJC7VXO4Y9KB6zZAxq0Vv80WN0l',
            ],
            [
                'name' => 'Nilo',
                'email' => 'mesero@gmail.com',
                'password' => Hash::make('mesera1234'), // password
                'role' => 'mesero',
                'image_employee' => 'https://lh3.googleusercontent.com/d/1acip8WUiGk1LN4rYiA0rP1qT7HM5oSGM',
            ],
            [
                'name' => 'Julia',
                'email' => 'asistentecocina1@gmail.com',
                'password' => Hash::make('asistente11234'), // password
                'role' => 'asistente_cocina',
                'image_employee' => 'https://lh3.googleusercontent.com/d/11hbUf8isRiqRYm8dJkUNOUScqyJlM9Q6',
            ],
        ];

        // Insertar varios usuarios y asignarles roles
        foreach ($users as $userData) {
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => $userData['password'],
                'profile_photo_path' => $userData['image_employee'] ?? null,
            ]);

            // Asignar rol al usuario recién creado
            $user->assignRole($userData['role']);
        }

        //Administracion
        // $user = User::create([
        //     'name' => 'Fernando',
        //     'email'    => 'admin@example.com',
        //     'password' => Hash::make('12345678'), // password

        // ])->assignRole('gerente_general');

        // $user =User::create([
        //     'name' => 'Xiomara',
        //     'email'    => 'xiomara@gmail.com',
        //     'password' => Hash::make('12345678'), // password

        // ])->assignRole('gerente_ventas');

        // $user =User::create([
        //     'name' => 'Luis',
        //     'email'    => 'chef@gmail.com',
        //     'password' => Hash::make('12345678'), // password

        // ])->assignRole('cocinero');

        // $user =User::create([
        //     'name' => 'Nilo',
        //     'email'    => 'mesero@gmail.com',
        //     'password' => Hash::make('12345678'), // password

        // ])->assignRole('mesero');

        // $user =User::create([
        //     'name' => 'Julia',
        //     'email'    => 'asistentecosina1@gmail.com',
        //     'password' => Hash::make('12345678'), // password

        // ])->assignRole('asistente_cosina');

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
