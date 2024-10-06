<?php

namespace App\Models;

use App\Enums\TableStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tables extends Model
{
    use HasFactory;

    public static $rules = [
        'number' => 'required',
        'description' => 'required',
        'capacity' => 'required',
        'status' => 'required',
    ];

    protected $fillable = [
        'number',
        'description',
        'capacity',
        'status',
    ];

    protected $casts = [
        'status' => TableStatus::class,
    ];
}
