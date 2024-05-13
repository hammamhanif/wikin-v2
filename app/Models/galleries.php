<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class galleries extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'description', 'image', 'community_id', 'user_id',
    ];
    public function community()
    {
        return $this->belongsTo(Communities::class);
    }

    /**
     * Get the user that created the gallery.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
