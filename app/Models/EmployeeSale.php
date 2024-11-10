<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSale extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'order_id', 'sale_amount'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
