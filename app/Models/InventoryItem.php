<?php

namespace App\Models;

use App\Enums\ItemType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InventoryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'supplier_id',
        'item_type',
        'quantity',
        'reorder_level',
        'unit_id',
    ];

    protected $casts = [
        'item_type' => ItemType::class,
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
