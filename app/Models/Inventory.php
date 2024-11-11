<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventory';

    protected $fillable = ['ingredient_id', 'item_name', 'quantity', 'reorder_level', 'unit'];

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
}
