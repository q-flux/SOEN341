<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Tweets;
use App\users;
use App\Follow;

class FollowController extends Controller
{
    public function Follow($id){
        //$id is the ID  of the user to follow

        $follow = Follow::where('follow_id', $id)->where('user_id', Auth::user()->id)->count();
        if ($follow){
            // has never been followed yet
            Follow::where('follow_id', $id)->delete();
            return redirect()->back();
        } else {
            Follow::create([
                'user_id' => Auth::user()->id,
                'follow_id' => $id
            ]);
            return redirect()->back();
        }

    }
    
}

// $userLikedTweet = Auth::user()->id;


// $likes = Like::where('tweet_id', $id)->where('user_id',$userLikedTweet)->count();


// if ($likes){
//     Like::where('tweet_id', $id)->delete();
//     Tweets::where("id", $id)->update([
//         'like_cnt'=> DB::raw('like_cnt-1')
//     ]);
//     return redirect()->back();
// }
// else {
//     Like::create([
//         'user_id' => Auth::user()->id,
//         'tweet_id' => $id
//     ]);
//     Tweets::where("id", $id)->update([
//         'like_cnt'=> DB::raw('like_cnt+1')
//     ]);
//     return redirect()->back();
// }
