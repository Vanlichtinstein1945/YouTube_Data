<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YouTubeChannelsModel extends Model
{
    public function videos()
    {
        return $this->hasMany(YouTubeVideoModel::class, 'channel_id');
    }
}
