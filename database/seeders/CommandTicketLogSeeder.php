<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommandTicketLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('command_ticket_logs')->insert([
            ['command_ticket_id' => 1, 'previous_status' => 'pending', 'new_status' => 'in_progress', 'change_date' => Carbon::now(), 'notes' => 'Se comenzó la preparación', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['command_ticket_id' => 1, 'previous_status' => 'in_progress', 'new_status' => 'completed', 'change_date' => Carbon::now()->addMinutes(10), 'notes' => 'Plato listo para servir', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
