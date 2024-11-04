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
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'category_id' => 'required|exists:categories,id',
        'types' => 'required|array|min:1',
        'prices' => 'required|array',
        'statuses' => 'required|array',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ];

    protected $fillable = [
        'name',
        //'price',
        'description',
        //'status',
        'image_producto',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function sizes()
    {
        return $this->belongsToMany(Sizes::class, 'product_size', 'product_id', 'size_id');
    }
}
