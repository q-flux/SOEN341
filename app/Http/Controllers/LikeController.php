<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Tweets;
use App\Like;

class LikeController extends Controller
{
    // this method likes the tweet if the current user hasn't liked the tweet before
    // if the user already liked the tweet, it unlikes the tweet
    public function LikeTweet($id)
    {

        $userLikedTweet = Auth::user()->id;


        $likes = Like::where('tweet_id', $id)->where('user_id', $userLikedTweet)->count();


        if ($likes) {
            Like::where('tweet_id', $id)->where('user_id',$userLikedTweet)->delete();
            Tweets::where("id", $id)->update([
                'like_cnt' => DB::raw('like_cnt-1')
            ]);
            return redirect()->back();
        } else {
            Like::create([
                'user_id' => Auth::user()->id,
                'tweet_id' => $id
            ]);
            Tweets::where("id", $id)->update([
                'like_cnt' => DB::raw('like_cnt+1')
            ]);
            return redirect()->back();
        }
    }
}
