<?php

use App\Enums\ItemType;
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
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->onDelete('set null');
            $table->string('name', 255);
            $table->enum('item_type', array_column(ItemType::cases(), 'value'));
            $table->integer('quantity');
            $table->integer('reorder_level');
            $table->decimal('cost_price', 10, 2);
            $table->integer('num_units')->nullable();
            // $table->string('flavor', 255)->nullable();
            $table->foreignId('unit_id')->constrained('units')->onDelete('restrict');
            $table->timestamp('last_updated')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_items');
    }
};
