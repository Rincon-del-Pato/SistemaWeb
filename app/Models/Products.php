<?php

namespace App\Models;

use App\Enums\TableStatusProd;
use Database\Seeders\SizeSeeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Products extends Model
{
    use HasFactory;

    public static $rules = [
        'name' => 'required',
        'price' => 'required',
        'description' => 'required',
        'status' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        'category_id' => 'required',
    ];

    protected $fillable = [
        'name',
        'price',
        'description',
        'status',
        'image_producto',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    public function sizes()
    {
        return $this->belongsToMany(Sizes::class, 'product_size', 'product_id', 'size_id');
    }
}
