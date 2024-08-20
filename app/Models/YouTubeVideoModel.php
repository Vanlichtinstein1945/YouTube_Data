<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YouTubeVideoModel extends Model
{
    public function ratings()
    {
        return $this->hasMany(YouTubeUserVideoModel::class, 'video_id');
    }

    public function averageRating()
    {
        return $this->ratings()->avg('user_rating');
    }

    public function channel()
    {
        return $this->belongsTo(YouTubeChannelsModel::class, 'channel_id');
    }
}
