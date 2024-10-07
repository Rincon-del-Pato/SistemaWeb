<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        // nombre: Restaurant El Rincon Del Pato
        // RUC: 10192178229
        // direccion: Calle. Alianza #798, Guadalupe, La Libertad, Peru
        // TELEFONO:  981 696 117
        // correo: juanramirezarana31@hotmail.com

        Settings::create([
            'name' => 'El Rincon Del Pato',
            'ruc' => '10192178229',
            'address' => 'Calle. Alianza #798',
            'phone' => '981696117',
            'email' => 'juanramirezarana31@hotmail.com',
            'city' => 'Guadalupe',
            'province' => 'La Libertad',
            'logo' => 'logo.png',
        ]);
    }
}
