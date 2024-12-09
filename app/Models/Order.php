<?php

namespace App\Models;

use App\Enums\OrderType;
use App\Enums\DeliveryStatus;
use App\Enums\PaymentsStatus;
use App\Enums\TakeawayStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $fillable = [
        'table_id',
        'customer_id',
        'num_guests',
        'user_id',
        'order_type',
        'payment_status',
        'total',
        'order_date',
        'delivery_address',
        'special_instructions'
    ];

    protected $casts = [
        'order_type' => OrderType::class,
        'payment_status' => PaymentsStatus::class,
        'status' => 'string'  // Cambiar el cast a string simple
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
        return $this->hasMany(OrderItem::class)->with('menuItem');
    }

    public function employeeSales()
    {
        return $this->hasMany(EmployeeSale::class);
    }

    public function commandTickets(): HasMany
    {
        return $this->hasMany(CommandTicket::class);
    }

    public function commandTicket()
    {
        return $this->hasOne(CommandTicket::class)->latest();
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class)->latest();
    }

    // Agregar este método para manejar el status según el tipo de orden
    // public function getStatusEnumAttribute()
    // {
    //     return match($this->order_type) {
    //         OrderType::ParaLlevar => TakeawayStatus::tryFrom($this->status),
    //         OrderType::Delivery => DeliveryStatus::tryFrom($this->status),
    //         default => null
    //     };
    // }
}
