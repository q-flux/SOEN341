<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Tweets;
use App\users;
use App\Follow;
use App\Listing;

class OtherUserController extends Controller
{
  /**
    *This method returns the profile for other user
    *   For adding images
    *
    *@param \Illuminate\Http\int $id
    *@return Illuminate\Http\Response
    */
    public function searchOther($id)
    {
        $tweets = Tweets::where("user_id", $id)->get();
        $username = users::where('id', $id)->first()->name;
        $userID = $id;
        $following = Follow::where('follow_id', $id)->where('user_id', Auth::user()->id)->count();
        $biography = users::where('id', $id)->first()->biography;
        $followerCount = sizeof(Follow::where('follow_id', $id)->get());
        $followingCount = sizeof(Follow::where('user_id', $id)->get());
        $listings = Listing::where("user_id", $id)->get();

        $followers = Follow::where("user_id", Auth::user()->id)->get();

        $output = array($tweets, $username, $userID, $following, $biography,
                        $followerCount, $followingCount, count($tweets));

        return view('otherUser', ['output' => $output])->with('listings', $listings)->with('followers', $followers);
    }
}
