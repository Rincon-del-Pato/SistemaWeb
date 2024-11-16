<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommandTicketItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('command_ticket_items')->insert([
            ['command_ticket_id' => 1, 'menu_item_id' => 1, 'quantity' => 2, 'special_requests' => 'Extra hielo', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['command_ticket_id' => 1, 'menu_item_id' => 2, 'quantity' => 1, 'special_requests' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['command_ticket_id' => 2, 'menu_item_id' => 3, 'quantity' => 1, 'special_requests' => 'Sin cebolla', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
