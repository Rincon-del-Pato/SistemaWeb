<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    public static $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'password' => 'required',
        'rols' => 'required',

        //J&z?3*Z.2zjK
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function adminlte_image()
    {
        // return 'https://picsum.photos/300/300';
        // if ($this->profile_photo_path) {
        //     return asset('storage/' . $this->profile_photo_path);
        // }

        if ($this->profile_photo_path) {
             return asset($this->profile_photo_path);
        }

        return 'https://picsum.photos/300/300';
    }

    public function adminlte_desc()
    {
        // return 'Admin';
        if ($this->roles->isNotEmpty()) {
            return $this->getRoleNames()->first();
        }

        return 'No Role';
    }

    public function adminlte_profile_url()
    {
        return url('usuarios/' . $this->id);
        //return 'profile/username';
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    public function getFullNameAttribute()
    {
        return $this->name . ' ' . ($this->employee ? $this->employee->lastname : '');
    }
}
