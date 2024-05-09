<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormPemas extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'noID',
        'nama_kegiatan',
        'location',
        'start_time',
        'end_time',
        'category',
        'content',
    ];
}
