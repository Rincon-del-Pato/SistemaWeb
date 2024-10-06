<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    use HasFactory;

    public static $rules = [
        'product_id' => 'required',
        'tag_id' => 'required',
    ];

    protected $fillable = [
        'product_id',
        'tag_id',
    ];

    public function product()
    {
        return $this->belongsTo(Products::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
