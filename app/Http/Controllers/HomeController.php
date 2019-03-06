<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Datetime;

use App\Tweets;
use App\feed;
use App\users;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->param = $request->param;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getDate($array){
        $dates;
        foreach ($array as $key=>$arr){
            $dates[$key] = $arr->time_posted;
        };
        return $dates;
    }
    public function index()
    {
        $user = Auth::user()->id;
        $tweets = Tweets::where("user_id", $user)->get();
        // $dates = $this->getDate($tweets);
        return view('home', ['tweets' => $tweets]); //, 'like' => $tweetsLike
    }
    public function create(Request $request)
    {
        $tweet = Tweets::create([
            'user_id' => Auth::user()->id,
            'like_cnt' => 0,
            'reply_cnt' => 0,
            'tweet_text' => $request->input('tweet'),
            'time_posted' => now(),
        ]);
            return redirect('/home');
    }   

    public function delete($id)
    {
      $tweet = Tweets::find($id);
      $tweet->delete();
      return redirect()->back();
    }
    public function feed()
    {

      $user = Auth::user()->id;
     $f_id = feed::where('id', $user)->get();
     $array = array();
     foreach ($f_id as $value) {
       array_push($array, $value->follow_id);
     }
     $tweets  = Tweets::whereIn('user_id',$array)->get();
     $names = users::whereIn('id',$array)->get();
     echo $f_id;
    return view('feed', ['tweets' => $tweets, 'f_id' => $f_id, 'names' => $names]);
   }
}
