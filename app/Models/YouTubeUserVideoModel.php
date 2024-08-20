<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YouTubeUserVideoModel extends Model
{
    protected $fillable = [
        'user_id',
        'video_id',
        'user_rating'
    ];

    public function user() {
        return $this->belongsTo(YouTubeUserModel::class, 'user_id');
    }

    public function video() {
        return $this->belongsTo(YouTubeVideoModel::class, 'video_id');
    }
}
