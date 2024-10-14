<?php

namespace App\Models;

use App\Enums\TableStatus;
use App\Enums\TableStatusTab;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tables extends Model
{
    use HasFactory;

    public static $rules = [
        'capacity' => 'required|array',
        'capacity.*' => 'required|integer|min:1',
        'quantity' => 'required|array',
        'quantity.*' => 'required|integer|min:1',
    ];

    protected $fillable = [
        'name',
        'capacity',
        'status',
    ];

    protected $casts = [
        'status' => TableStatusTab::class,
    ];
}
