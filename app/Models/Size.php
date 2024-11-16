<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable = ['size_name', 'description'];

    public function menuItems()
    {
        return $this->belongsToMany(MenuItem::class, 'menu_item_sizes')
                    ->withPivot('price')
                    ->withTimestamps();
    }
}
