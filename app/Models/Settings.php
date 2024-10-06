<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    public static $rules = [
        'name' => 'required',
        'ruc' => 'required',
        'address' => 'required',
        'phone' => 'required',
        'email' => 'required',
        'logo' => 'required',
    ];


}
