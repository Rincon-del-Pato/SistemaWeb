<?php

namespace App\Models;

use App\Enums\TableStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
