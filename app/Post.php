<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	public $with = ['user', 'likes', 'comments'];

    protected $fillable = [
        'user_id', 'content', 'image',
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function likes()
    {
    	return $this->hasMany('App\Like');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment')->orderBy('created_at', 'desc');
    }
}
