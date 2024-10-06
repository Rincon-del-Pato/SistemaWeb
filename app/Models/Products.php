<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    public static $rules = [
        'name' => 'required',
        'price' => 'required',
        'description' => 'required',
        'type' => 'required',
        'stock' => 'required',
        'status' => 'required',
        'category_id' => 'required',
    ];

    protected $fillable = [
        'name',
        'price',
        'description',
        'type',
        'stock',
        'status',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
}
