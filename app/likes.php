<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class likes extends Model
{
    public function user(){
      return $this->belongsTo('App\User');
    }
    public function tweet(){
      return $this->belongsTo('App\Tweets');
    }
}
