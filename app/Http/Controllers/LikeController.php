<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Tweets;

class LikeController extends Controller
{
    //
    /*
    public function LikeTweet(Request $request){
        $output = "";

        $tweets_id = $request['tweets_id'];
        $update = false;
        $tweet = Tweets::find($tweets_id);
        if (!$tweet) {
            return null;
        }
        $user = Auth::User();
        $like = $User->likes()->where('tweets_id', $tweets_id)->first();
        if ($like) {
          $update = true;
        $like->delete();
                return null;
              }
        else {
            $like = new Like();
        }
        $like->user_id = $user->id;
        $like->tweets_id = $tweet->id;

        if ($update) {
            $like->update();
        } else {
            $like->save();
        }
        return null;
*/
    public function LikeTweet(Request $request){
        $output = "";
        if ($request->ajax()){
            Tweets::where("id", $request->data)->update([
                'like_cnt'=> DB::raw('like_cnt+1')
            ]);
            $output = Tweets::where("id", $request->data)->get(['like_cnt']);
            $tweetID = $request->data;
            return response()->json([
                $output,
                $tweetID
            ], 200);
        }

    }
}
