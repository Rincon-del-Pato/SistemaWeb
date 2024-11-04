<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;

    protected $table = 'product_size';

    protected $fillable = [
        'product_id',
        'size_id'
    ];

    // Relación con Product
    public function product()
    {
        return $this->belongsTo(Products::class);
    }

    // Relación con Size
    public function size()
    {
        return $this->belongsTo(Sizes::class);
    }
}
