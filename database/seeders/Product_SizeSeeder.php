<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Product_SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('product_size')->insert([
            // Entradas (category_id = 1)
            [
                'product_id' => 1,
                'size_id' => 1,
            ],
            [
                'product_id' => 2,
                'size_id' => 2,
            ],
            [
                'product_id' => 3,
                'size_id' => 3,
            ],
            // Pescados y Mariscos (category_id = 2)
            [
                'product_id' => 4,
                'size_id' => 4,
            ],
            [
                'product_id' => 5,
                'size_id' => 5,
            ],
            // Jaleas (category_id = 3)
            [
                'product_id' => 6,
                'size_id' => 6,
            ],
            [
                'product_id' => 6,
                'size_id' => 7,
            ],
            // Chicharrones (category_id = 4)
            [
                'product_id' => 7,
                'size_id' => 8,
            ],
            [
                'product_id' => 8,
                'size_id' => 9,
            ],
            // Platos de la casa (category_id = 5)
            [
                'product_id' => 9,
                'size_id' => 10,
            ],
            [
                'product_id' => 10,
                'size_id' => 11,
            ],
            // Tacu tacu (category_id = 6)
            [
                'product_id' => 11,
                'size_id' => 12,
            ],
            [
                'product_id' => 12,
                'size_id' => 13,
            ],
            // Sopas (category_id = 7)
            [
                'product_id' => 13,
                'size_id' => 14,
            ],
            [
                'product_id' => 14,
                'size_id' => 15,
            ],
            // Refrescos (category_id = 8)
            [
                'product_id' => 15,
                'size_id' => 16,
            ],
            [
                'product_id' => 16,
                'size_id' => 17,
            ],
        ]);
    }
}
