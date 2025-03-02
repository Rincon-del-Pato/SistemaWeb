<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('command_ticket_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('command_ticket_id')->constrained('command_tickets')->onDelete('cascade');
            $table->string('previous_status')->nullable();
            $table->string('new_status');
            $table->timestamp('change_date')->useCurrent();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('command_ticket_logs');
    }
};
