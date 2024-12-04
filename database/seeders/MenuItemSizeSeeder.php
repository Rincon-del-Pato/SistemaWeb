<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MenuItemSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('menu_item_sizes')->insert([
            [
                'menu_item_id' => 1,
                'size_id' => 1,
                'price' => 3.50,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 2,
                'size_id' => 1,
                'price' => 32.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 3,
                'size_id' => 1,
                'price' => 20.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 4,
                'size_id' => 1,
                'price' => 28.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 5,
                'size_id' => 1,
                'price' => 34.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 6,
                'size_id' => 1,
                'price' => 23.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 7,
                'size_id' => 1,
                'price' => 36.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 8,
                'size_id' => 1,
                'price' => 4.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 9,
                'size_id' => 1,
                'price' => 29.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 9,
                'size_id' => 2,
                'price' => 57.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 10,
                'size_id' => 1,
                'price' => 22.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 10,
                'size_id' => 2,
                'price' => 39.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 11,
                'size_id' => 1,
                'price' => 32.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 12,
                'size_id' => 1,
                'price' => 28.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 12,
                'size_id' => 2,
                'price' => 51.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 13,
                'size_id' => 1,
                'price' => 32.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 13,
                'size_id' => 2,
                'price' => 63.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'menu_item_id' => 14,
                'size_id' => 1,
                'price' => 34.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 15,
                'size_id' => 1,
                'price' => 36.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 15,
                'size_id' => 2,
                'price' => 71.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 16,
                'size_id' => 1,
                'price' => 33.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 16,
                'size_id' => 2,
                'price' => 67.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 17,
                'size_id' => 1,
                'price' => 37.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 17,
                'size_id' => 2,
                'price' => 66.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 18,
                'size_id' => 1,
                'price' => 24.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 18,
                'size_id' => 2,
                'price' => 43.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'menu_item_id' => 19,
                'size_id' => 1,
                'price' => 31.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 19,
                'size_id' => 2,
                'price' => 61.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 20,
                'size_id' => 1,
                'price' => 20.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 21,
                'size_id' => 1,
                'price' => 19.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 22,
                'size_id' => 1,
                'price' => 33.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'menu_item_id' => 23,
                'size_id' => 1,
                'price' => 28.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 23,
                'size_id' => 2,
                'price' => 55.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 24,
                'size_id' => 1,
                'price' => 31.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 24,
                'size_id' => 2,
                'price' => 60.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 25,
                'size_id' => 1,
                'price' => 32.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 25,
                'size_id' => 2,
                'price' => 60.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 26,
                'size_id' => 1,
                'price' => 34.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 26,
                'size_id' => 2,
                'price' => 65.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'menu_item_id' => 27,
                'size_id' => 1,
                'price' => 44.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 27,
                'size_id' => 2,
                'price' => 75.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'menu_item_id' => 28,
                'size_id' => 1,
                'price' => 31.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 29,
                'size_id' => 1,
                'price' => 50.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 30,
                'size_id' => 1,
                'price' => 45.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 31,
                'size_id' => 1,
                'price' => 44.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'menu_item_id' => 32,
                'size_id' => 1,
                'price' => 28.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 33,
                'size_id' => 1,
                'price' => 30.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 33,
                'size_id' => 2,
                'price' => 56.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 34,
                'size_id' => 1,
                'price' => 32.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 34,
                'size_id' => 2,
                'price' => 61.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 35,
                'size_id' => 1,
                'price' => 34.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 35,
                'size_id' => 2,
                'price' => 66.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 36,
                'size_id' => 1,
                'price' => 37.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 36,
                'size_id' => 2,
                'price' => 71.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 37,
                'size_id' => 1,
                'price' => 46.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 37,
                'size_id' => 2,
                'price' => 81.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 38,
                'size_id' => 1,
                'price' => 28.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 38,
                'size_id' => 2,
                'price' => 55.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 39,
                'size_id' => 1,
                'price' => 28.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 39,
                'size_id' => 2,
                'price' => 55.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'menu_item_id' => 40,
                'size_id' => 1,
                'price' => 15.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 40,
                'size_id' => 2,
                'price' => 28.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 41,
                'size_id' => 1,
                'price' => 23.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 41,
                'size_id' => 2,
                'price' => 40.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 42,
                'size_id' => 1,
                'price' => 25.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 42,
                'size_id' => 2,
                'price' => 45.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 43,
                'size_id' => 1,
                'price' => 23.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 43,
                'size_id' => 2,
                'price' => 36.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 44,
                'size_id' => 1,
                'price' => 30.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 45,
                'size_id' => 1,
                'price' => 4.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'menu_item_id' => 46,
                'size_id' => 1,
                'price' => 26.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 47,
                'size_id' => 1,
                'price' => 31.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 48,
                'size_id' => 1,
                'price' => 33.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 49,
                'size_id' => 1,
                'price' => 28.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 50,
                'size_id' => 1,
                'price' => 32.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 51,
                'size_id' => 1,
                'price' => 27.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 52,
                'size_id' => 1,
                'price' => 35.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 53,
                'size_id' => 1,
                'price' => 31.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'menu_item_id' => 54,
                'size_id' => 1,
                'price' => 17.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 55,
                'size_id' => 1,
                'price' => 15.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 56,
                'size_id' => 1,
                'price' => 13.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'menu_item_id' => 57,
                'size_id' => 1,
                'price' => 13.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 58,
                'size_id' => 1,
                'price' => 13.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 59,
                'size_id' => 1,
                'price' => 2.50,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 60,
                'size_id' => 1,
                'price' => 7.50,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 61,
                'size_id' => 1,
                'price' => 8.50,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 62,
                'size_id' => 1,
                'price' => 4.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'menu_item_id' => 63,
                'size_id' => 1,
                'price' => 7.50,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
