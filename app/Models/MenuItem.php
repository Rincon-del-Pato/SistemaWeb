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
        'available'
    ];

    protected $casts = [
        'available' => 'boolean'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'menu_item_sizes')
                    ->withPivot('price')
                    ->withTimestamps();
    }

    public function inventoryItems()
    {
        return $this->belongsToMany(InventoryItem::class, 'menu_item_inventory')
                    ->withPivot('quantity_needed_per_unit')
                    ->withTimestamps();
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
