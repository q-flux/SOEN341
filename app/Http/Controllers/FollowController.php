<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Tweets;
use App\users;
use App\Follow;

class FollowController extends Controller
{
    /**
     * Follows another user
     * $id will be used in the follow function as the ID of the user to follow
     * @param  int $id
     * @return void
     */
    public function Follow($id)
    {
      $follow = Follow::where('follow_id', $id)->where('user_id', Auth::user()->id)->count();
        if ($follow)
        {
            Follow::where('follow_id', $id)->where('user_id', Auth::user()->id)->delete();
            return redirect()->back();
        }

        else
        {
            Follow::create([
                'user_id' => Auth::user()->id,
                'follow_id' => $id
            ]);
            return redirect()->back();
        }

    }

}
