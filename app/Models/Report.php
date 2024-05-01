<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable = ['news_id', 'reported_by_user_id', 'reported_user_id', 'reason'];

    public function news()
    {
        return $this->belongsTo(News::class);
    }

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reported_by_user_id');
    }

    public function reportedUser()
    {
        return $this->belongsTo(User::class, 'reported_user_id');
    }
}
