<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function news()
    {
        return $this->hasMany(News::class);
    }
    public function pemas()
    {
        return $this->hasMany(pemas::class);
    }

    public function communities()
    {
        return $this->hasMany(Communities::class);
    }
    public function forms()
    {
        return $this->hasMany(FormPemas::class, 'name', 'name');
    }
    public function galleries()
    {
        return $this->hasMany(galleries::class);
    }
    public function registrasiPemas()
    {
        return $this->hasMany(RegistrasiPemas::class);
    }
    public function registrasiCommunities()
    {
        return $this->hasMany(RegistrasiCommunities::class);
    }
}
