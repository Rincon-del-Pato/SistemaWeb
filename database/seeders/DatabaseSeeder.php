<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            RolesPermisosSeeder::class,
            UserSeeder::class,
            SettingsSeeder::class,
            CategorySeeder::class,
            MenuItemSeeder::class,
            SizeSeeder::class,
            MenuItemSizeSeeder::class,
            TableSeeder::class,
            EmployeeSeeder::class,
            CustomersSeeder::class,

            UnitSeeder::class,
            SupplierSeeder::class,
            InventoryItemSeeder::class,
            MenuItemSeeder::class
        ]);
    }
}
