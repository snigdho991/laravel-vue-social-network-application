<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'university', 'uni_from', 'uni_to', 'subject', 'company', 'designation', 'from', 'to', 'location',
    ];

    public function user()
    {
        return $this->belongsTo('App\User'); 
    }
}
