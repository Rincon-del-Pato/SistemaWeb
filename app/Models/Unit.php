<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'unit_name',
        'abbreviation',
        'description',
    ];

    public function sizes()
    {
        return $this->hasMany(Size::class);
    }

    public function inventoryItems()
    {
        return $this->hasMany(InventoryItem::class);
    }
}
