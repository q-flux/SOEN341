<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 

use App\Tweets;

class LikeController extends Controller
{
    //
    public function LikeTweet(Request $request){
        $output = "";
        if ($request->ajax()){
            Tweets::where("id", $request->id)->update([
                'like_cnt'=> DB::raw('like_cnt+1')
            ]);
            $output = Tweets::where("id", $request->id)->get(['like_cnt']);
            $tweetID = $request->id;
            return response()->json([
                $output,
                $tweetID
            ], 200);
        }
      
    }
}
