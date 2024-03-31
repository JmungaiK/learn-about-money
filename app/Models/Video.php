<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'thumbnail',
        'youtube_url',
        'duration'
    ];

    /**
     * Get the average rating for this video.
     *
     * @return float
     */
    public function averageRating()
    {
        $totalRatings = $this->ratings()->count();

        if ($totalRatings === 0) {
            return 0; // Return 0 if there are no ratings yet
        }

        $totalRatingSum = $this->ratings()->sum('rating');

        return $totalRatingSum / $totalRatings;
    }


    // 
    /**
     * Define the relationship with modules through ModuleMapping
     */
    public function modules()
    {
        return $this->belongsToMany(Module::class, 'module_videos', 'video_id', 'module_id');
    }

    /**
     * Get the ratings for the video.
     */
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    /**
     * Get the comments for the video.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Connect to modules table
     */
    public function moduleVideos()
    {
        return $this->hasMany(ModuleVideo::class);
    }

    public function progress()
    {
        return $this->hasMany(Progress::class);
    }
}
