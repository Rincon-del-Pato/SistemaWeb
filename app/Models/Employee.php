<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
    use HasRoles;

    public static $rules = [
        'lastname' => 'required|string|max:255',
        'name' => 'required|string|max:255',
        'age' => 'required|integer',
        'dni' => 'required|string|max:255',
        'phone' => 'required|integer',
        'rols' => 'required',
        'email' => 'required|email',
        'password' => 'required',
        'address' => 'required|string',
        'city' => 'required|string',
        'image' => 'image|mimes:jpeg,png,jpg|max:2048',
    ];

    protected $fillable = ['lastname', 'dni', 'age', 'phone', 'address', 'city', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sales()
    {
        return $this->hasMany(EmployeeSale::class);
    }
}
