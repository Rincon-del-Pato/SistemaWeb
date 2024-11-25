<?php

namespace App\Models;

use App\Enums\TableStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Table extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_number',
        'seating_capacity',
        'status'
    ];

    protected $casts = [
        'status' => TableStatus::class
    ];

    protected $appends = ['waiterName', 'num_guests'];

    public function getWaiterNameAttribute()
    {
        if ($this->status->value === 'Ocupado' && $this->orders->isNotEmpty()) {
            $order = $this->orders->first();
            $firstName = explode(' ', $order->user->name)[0];
            $lastName = explode(' ', optional($order->user->employee)->lastname)[0];
            return $firstName . ' ' . $lastName;
        }
        return null;
    }

    public function getNumGuestsAttribute()
    {
        return $this->status->value === 'Ocupado' && $this->orders->isNotEmpty() 
            ? $this->orders->first()->num_guests 
            : 0;
    }

    public function orders()
    {
        return $this->hasMany(Order::class)->latest();
    }

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('status', TableStatus::Disponible->value);
    }
}
