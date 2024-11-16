<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'image_url',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //Relacionar con la tabla size
    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'menu_item_sizes')
                    ->withPivot('price')
                    ->withTimestamps();
    }

    public function inventoryItems()
    {
        return $this->belongsToMany(InventoryItem::class, 'menu_inventory_link')
                    ->withTimestamps();
    }
}
