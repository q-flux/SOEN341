<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweets extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    
    public function photos()
    {
      return $this->hasOne('App\Photo');
    }
}
