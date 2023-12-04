<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Blog extends Model implements HasMedia
{
    use HasMediaTrait;
    
    protected $fillable = [
        'title', 'user_id', 'description'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function comments()
    {
        return $this->hasMany('App\Models\Comment','blog_id', 'id');
    }
}
