<?php

namespace App\Models;

use App\Enums\OrderType;
use App\Enums\PaymentsStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'table_id',
        'num_guests',
        'user_id',
        'total',
        'order_type',
        'payment_status'
    ];

    protected $casts = [
        'order_type' => OrderType::class,
        'payment_status' => PaymentsStatus::class
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function table(): BelongsTo
    {
        return $this->belongsTo(Table::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function employee()
    {
        return $this->user->employee();
    }

    public function getWaiterFullNameAttribute()
    {
        return $this->user ? $this->user->getFullNameAttribute() : 'No asignado';
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function employeeSales()
    {
        return $this->hasMany(EmployeeSale::class);
    }
}
