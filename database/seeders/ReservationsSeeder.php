<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReservationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('reservations')->insert([
            ['customer_id' => 1, 'table_id' => 1, 'reservation_time' => '2024-11-10 12:00:00', 'num_guests' => 4, 'status' => 'Confirmado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['customer_id' => 2, 'table_id' => 2, 'reservation_time' => '2024-11-10 13:30:00', 'num_guests' => 2, 'status' => 'Confirmado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['customer_id' => 3, 'table_id' => 3, 'reservation_time' => '2024-11-11 12:00:00', 'num_guests' => 4, 'status' => 'Confirmado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['customer_id' => 4, 'table_id' => 4, 'reservation_time' => '2024-11-11 13:30:00', 'num_guests' => 6, 'status' => 'Confirmado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['customer_id' => 5, 'table_id' => 5, 'reservation_time' => '2024-11-12 14:00:00', 'num_guests' => 4, 'status' => 'Confirmado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['customer_id' => 6, 'table_id' => 6, 'reservation_time' => '2024-11-12 15:30:00', 'num_guests' => 2, 'status' => 'Confirmado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['customer_id' => 7, 'table_id' => 7, 'reservation_time' => '2024-11-13 16:00:00', 'num_guests' => 4, 'status' => 'Confirmado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['customer_id' => 8, 'table_id' => 8, 'reservation_time' => '2024-11-13 17:30:00', 'num_guests' => 6, 'status' => 'Confirmado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['customer_id' => 9, 'table_id' => 9, 'reservation_time' => '2024-11-14 18:00:00', 'num_guests' => 4, 'status' => 'Confirmado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['customer_id' => 10, 'table_id' => 10, 'reservation_time' => '2024-11-14 19:30:00', 'num_guests' => 2, 'status' => 'Confirmado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['customer_id' => 11, 'table_id' => 11, 'reservation_time' => '2024-11-15 12:00:00', 'num_guests' => 4, 'status' => 'Confirmado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['customer_id' => 12, 'table_id' => 12, 'reservation_time' => '2024-11-15 13:30:00', 'num_guests' => 6, 'status' => 'Confirmado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['customer_id' => 13, 'table_id' => 13, 'reservation_time' => '2024-11-16 14:00:00', 'num_guests' => 4, 'status' => 'Confirmado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['customer_id' => 14, 'table_id' => 14, 'reservation_time' => '2024-11-16 15:30:00', 'num_guests' => 2, 'status' => 'Confirmado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['customer_id' => 15, 'table_id' => 15, 'reservation_time' => '2024-11-17 16:00:00', 'num_guests' => 4, 'status' => 'Confirmado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['customer_id' => 16, 'table_id' => 16, 'reservation_time' => '2024-11-17 17:30:00', 'num_guests' => 6, 'status' => 'Confirmado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['customer_id' => 17, 'table_id' => 17, 'reservation_time' => '2024-11-18 18:00:00', 'num_guests' => 4, 'status' => 'Confirmado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['customer_id' => 18, 'table_id' => 18, 'reservation_time' => '2024-11-18 19:30:00', 'num_guests' => 2, 'status' => 'Confirmado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['customer_id' => 19, 'table_id' => 19, 'reservation_time' => '2024-11-19 12:00:00', 'num_guests' => 4, 'status' => 'Confirmado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['customer_id' => 20, 'table_id' => 20, 'reservation_time' => '2024-11-19 13:30:00', 'num_guests' => 6, 'status' => 'Confirmado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
