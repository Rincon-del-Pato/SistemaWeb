<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = ['method_name', 'description'];

    public function paymentDetails()
    {
        return $this->hasMany(PaymentDetail::class);
    }
}
