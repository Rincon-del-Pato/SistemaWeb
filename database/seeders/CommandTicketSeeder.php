<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommandTicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('command_tickets')->insert([
            ['order_id' => 1, 'status' => 'pending', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 2, 'status' => 'in_progress', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['order_id' => 3, 'status' => 'completed', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
