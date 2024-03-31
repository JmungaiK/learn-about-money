<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'module',
        'description'
    ];

    // Define the relationship with videos through ModuleMapping
    public function videos()
    {
        return $this->belongsToMany(Video::class, 'module_videos', 'module_id', 'video_id');
    }

    // Define the relationship with videos through ModuleVideo
    public function moduleVideos()
    {
        return $this->hasMany(ModuleVideo::class);
    }
}
