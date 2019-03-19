<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use \Datetime;

use App\Tweets;
use App\feed;
use App\users;
use App\Follow;
use DB;

use App\User;

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
    public function getDate($array)
    {
        $dates;
        foreach ($array as $key => $arr) {
            $dates[$key] = $arr->time_posted;
        };
        return $dates;
    }

    // this method gets called when user submits the edit panel
    public function edit(Request $request)
    {
        users::where('id', Auth::user()->id)
            ->update(['biography' => $request->input('biography')]);

        return redirect()->back();
    }

    // this method returns tweets when the user goes to /home
    public function index()
    {
        $user = Auth::user()->id;
        $tweets = Tweets::where("user_id", $user)->get();

        // $dates = $this->getDate($tweets);

        $user_id = auth()->user()->id;
        $users = User::find($user_id);

        return view('home', ['tweets' => $tweets])->with('listings', $users->listings); //, 'like' => $tweetsLike

    }

    // this method adds new image
    public function addImage(Request $request)
    {
        $file = $request->file('image'); // Get file from the form
        $filename = Auth::user()->name . '-' . Auth::user()->id . '.jpg'; // name the file according to username
        if ($file) // was file retrieved from the request?
            {
                // then we store
                Storage::disk('local')->put($filename, File::get($file));
            }
        return redirect('/home'); // redirect back to home
    }

    // this method gets user image when the home page is loaded
    public function getUserImage($filename)
    {
        $file = Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }

    // this method creates a new tweet
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

    // this method deletes the tweet based on the ID
    public function delete($id)
    {
        $tweet = Tweets::find($id);
        $tweet->delete();
        return redirect()->back();
    }

    // this method gets the feed and redirects to the feed page
    public function feed()
    {
        $user = Auth::user()->id;
        $f_id = Follow::where('user_id', Auth::user()->id)->get();
        echo(sizeof($f_id));
        $array = array();
        foreach ($f_id as $value) {
            array_push($array, $value->follow_id);
        }
        $tweets  = Tweets::whereIn('user_id', $array)->get();

        $names = users::whereIn('id', $array)->get();
        return view('feed', ['tweets' => $tweets, 'f_id' => $f_id, 'names' => $names]);
    }

    //Counts the number of Followers
    public static function getFollowersCount()
    {
      $user = Auth::user()->id;
      $f_id = Follow::where('follow_id', Auth::user()->id)->get();
      return sizeof($f_id);
    }

    public static function getFollowingCount()
    {
      $user = Auth::user()->id;
      $f_id = Follow::where('user_id', Auth::user()->id)->get();
      return sizeof($f_id);
    }
}
