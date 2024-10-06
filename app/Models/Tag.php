<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    public $rules = [
        'name' => 'required',
    ];

    protected $fillable = [
        'name',
    ];

    public function products()
    {
        return $this->belongsToMany(Products::class);
    }
}
