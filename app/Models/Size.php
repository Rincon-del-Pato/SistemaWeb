<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable = [
        'size_name',
        'description',
        'volume',
        'unit_id'
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function menuItems()
    {
        return $this->belongsToMany(MenuItem::class, 'menu_item_sizes')
                    ->withPivot('price')
                    ->withTimestamps();
    }
}
