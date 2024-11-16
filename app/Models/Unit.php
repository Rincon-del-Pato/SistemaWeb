<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_name',
        'abbreviation',
        'description',
    ];

    public function inventoryItems()
    {
        return $this->hasMany(InventoryItem::class);
    }
}
