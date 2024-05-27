<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class   Communities extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'category', 'content', 'slug', 'link_number', 'image', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function galleries()
    {
        return $this->hasMany(galleries::class);
    }

    public function registrasiCommunities()
    {
        return $this->hasMany(RegistrasiCommunities::class);
    }
}
