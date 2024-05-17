<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommentPemas extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function childrens()
    {
        return $this->hasMany(CommentPemas::class, 'comment_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function hasLike()
    {
        return $this->hasOne(LikesPemas::class, 'comment_id')->where('likes_pemas.user_id', Auth::user()->id);
    }

    public function totalLikes()
    {
        return $this->hasMany(LikesPemas::class, 'comment_id')->count();
    }
}
