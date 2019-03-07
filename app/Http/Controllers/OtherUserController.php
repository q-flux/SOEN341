<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Tweets;
use App\users;
use App\Follow;

class OtherUserController extends Controller
{
    public function searchOther($id){
        $tweets = Tweets::where("user_id", $id)->get();
        $username = users::where('id', $id)->first()->name;
        $userID = $id;
        $following = Follow::where('follow_id', $id)->where('user_id', Auth::user()->id)->count();
     

        // $user = DB::table('users')->where('id', $id)->first();
        $output = array($tweets, $username, $userID, $following);

        // $dates = $this->getDate($tweets);
        return view('otherUser', ['output' => $output]); //, 'like' => $tweetsLike 
    }
}
