<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sizes extends Model
{
    use HasFactory;

    public $rules = [
        'name' => 'required',
    ];

    protected $fillable = [
        'type',
        'price',
        'status',
    ];

    public function products()
    {
        return $this->belongsToMany(Products::class, 'product_size', 'size_id', 'product_id');
    }
}
