<?php

use App\Enums\PaymentsStatus;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained('customers')->onDelete('set null');
            $table->foreignId('table_id')->nullable()->constrained('tables')->onDelete('set null');
            $table->decimal('total', 10, 2);
            $table->enum('order_type', ['dine_in', 'takeaway', 'delivery']);
            $table->timestamp('order_date')->useCurrent();
            $table->enum('payment_status', ['pending', 'paid', 'cancelled']);
            $table->string('delivery_address', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
