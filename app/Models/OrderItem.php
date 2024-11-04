<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    //use HasFactory;

    protected $table = 'order_items';

    protected $fillable = [
        'order_id',
        'product_size_id',
        'quantity',
        'unit_price',
        'subtotal',
        'special_instructions'
    ];

    public function order()
    {
        return $this->belongsTo(Orders::class);
    }
}
