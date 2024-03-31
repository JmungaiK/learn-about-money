<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'video_id'
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }


    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}
