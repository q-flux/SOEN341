<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public $timestamps = false;
    protected $fillable = array('user_id', 'tweet_text', 'photo');

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
    
    public function tweet()
    {
    	return $this->belongsTo('App\Tweets');
    }
}
