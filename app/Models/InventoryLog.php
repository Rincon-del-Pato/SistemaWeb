<?php

namespace App\Models;

use App\Enums\ChangeType;
use Illuminate\Database\Eloquent\Model;

class InventoryLog extends Model
{
    protected $table = 'inventory_log';
    public $timestamps = false;
    
    protected $fillable = [
        'inventory_item_id',
        'change_type',
        'quantity_change',
        'notes',
        'change_date'
    ];

    protected $casts = [
        'change_type' => ChangeType::class,
        'change_date' => 'datetime'
    ];

    public function inventoryItem()
    {
        return $this->belongsTo(InventoryItem::class);
    }
}