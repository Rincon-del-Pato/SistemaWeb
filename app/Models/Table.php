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

    protected $appends = ['waiterName'];

    public function getWaiterNameAttribute()
    {
        if ($this->status->value === 'Ocupado') {
            $order = $this->orders->first();
            $employee = $order ? Employee::where('user_id', $order->user_id)->first() : null;
            if ($employee) {
                // Obtener solo el primer nombre del usuario
                $firstName = explode(' ', $employee->user->name)[0];
                // Obtener solo el primer apellido
                $lastName = explode(' ', $employee->lastname)[0];
                return $firstName . ' ' . $lastName;
            }
            return 'No asignado';
        }
        return null;
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('status', TableStatus::Disponible->value);
    }
}
