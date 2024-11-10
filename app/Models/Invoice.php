<?php

namespace App\Models;

use App\Enums\InvoiceType;
use App\Enums\CustomerDocumentType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 'invoice_type', 'series', 'number', 'issue_date', 'total', 'tax',
        'customer_name', 'customer_document_type', 'customer_document_number', 'customer_address'
    ];

    protected $casts = [
        'invoice_type' => InvoiceType::class,
        'customer_document_type' => CustomerDocumentType::class,
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
