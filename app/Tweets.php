<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweets extends Model
{
    public $timestamps = false;
    protected $guarded = [];


    /**
    *   For returning the photo route
    *
    *@return Illuminate\Database\Eloquent\Tweets
    */

    public function photos()
    {
      return $this->hasOne('App\Photo');
    }
}
