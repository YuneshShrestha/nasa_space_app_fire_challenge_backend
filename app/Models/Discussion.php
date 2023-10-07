<?php

namespace App\Models;

use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Discussion extends Model
{
    use HasFactory;
    public function user(){
        return $this->hasMany(User::class, 'id', 'user_id');
    }
    public function video(){
        return $this->hasOne(Video::class, 'id', 'video_id');
    }
}
