<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceSeries extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_type',
        'series',
        'current_number',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
}
