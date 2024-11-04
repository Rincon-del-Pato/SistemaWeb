<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    // use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'table_id',
        'employee_id',
        'total_amount',
        'status',
        'notes'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
