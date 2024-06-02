<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormPemas extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function registrasiPemas()
    {
        return $this->hasMany(RegistrasiPemas::class);
    }
    public function pemas()
    {
        return $this->hasMany(pemas::class);
    }
}
