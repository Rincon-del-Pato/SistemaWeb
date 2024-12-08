<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    use HasFactory;

    public $timestamps = false;  // Desactivar timestamps

    protected $fillable = [
        'order_id',
        'payment_method_id',
        'amount',
        'payment_date'
    ];

    protected $dates = ['payment_date'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
