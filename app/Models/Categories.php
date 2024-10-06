<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    public static $rules = [
        'name' => 'required',
    ];

    protected $fillable = [
        'name',
    ];

    public function products()
    {
        return $this->hasMany(Products::class);
    }
}
