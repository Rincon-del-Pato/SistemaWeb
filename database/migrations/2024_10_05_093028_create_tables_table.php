<?php

use App\Enums\TableStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tables', function (Blueprint $table) {
            $table->id(); 
            $table->string('table_number', 10);
            $table->integer('seating_capacity');
            $table->enum('status', array_column(TableStatus::cases(), 'value'))->default(TableStatus::Disponible->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tables');
    }
};
