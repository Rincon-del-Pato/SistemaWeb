<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public static $rules = [
        'name' => 'required|string',
        'description' => 'required|string',
    ];

    protected $fillable = ['name', 'description'];

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }
}
