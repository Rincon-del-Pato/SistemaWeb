<?php

use App\Enums\InvoiceType;
use App\Enums\CustomerDocumentType;
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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->enum('invoice_type', array_column(InvoiceType::cases(), 'value'));
            $table->string('series', 4);
            $table->integer('number');
            $table->timestamp('issue_date')->useCurrent();
            $table->decimal('total', 10, 2);
            $table->decimal('tax', 10, 2);
            $table->string('customer_name', 255);
            $table->enum('customer_document_type', ['DNI', 'RUC']);
            $table->string('customer_document_number', 20);
            $table->string('customer_address', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
