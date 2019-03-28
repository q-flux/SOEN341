<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
  /**
  *   For getting the user
  *
  *@return Illuminate\Database\Eloquent\Listing
  */
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
