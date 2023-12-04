<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'name', 'user_id', 'mail', 'url', 'description','blog_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function blog()
    {
        return $this->belongsTo('App\Models\Blog','blog_id');
    }
}
