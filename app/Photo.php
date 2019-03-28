<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public $timestamps = false;
    protected $fillable = array('user_id', 'tweet_text', 'photo');

    /**
    *   For returning the user
    *
    *@return Illuminate\Databse\Eloquent\Photo
    */

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    /**
    *   For returning the tweet
    *
    *@return Illuminate\Database\Eloquent\Photo
    */

    public function tweet()
    {
    	return $this->belongsTo('App\Tweets');
    }
}
