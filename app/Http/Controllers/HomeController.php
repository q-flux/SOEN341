<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use \Datetime;

use App\Tweets;
use App\Photo;
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
        // $dates;
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
                Storage::disk('public')->put($filename, File::get($file));
            }
        return redirect('/home'); // redirect back to home
    }

    // this method gets user image when the home page is loaded
    public function getUserImage($filename)
    {
        $file = Storage::disk('public')->get($filename);
        return new Response($file, 200);
    }   

    // this method creates a new tweet
    public function create(Request $request)
    {
        if ($request->input('tweet') != null)
        {
            $tweet = Tweets::create([
                'user_id' => Auth::user()->id,
                'like_cnt' => 0,
                'reply_cnt' => 0,
                'tweet_text' => $request->input('tweet'),
                'time_posted' => now(),
            ]);  
        }
        return redirect()->back(); 
    }

    // this method deletes the tweet based on the ID
    public function delete($id)
    {
        $tweet = Tweets::find($id);
        $tweet->delete();
        return redirect()->back()->with('success', 'Tweet Deleted');
    }

    // this method deletes photo based on id
    public function deletePhoto($id)
    {
        $tweet = Tweets::find($id);
        $photo = Photo::find($tweet->photo_id);
        if(Storage::delete('public/photos/'.$photo->photo)){
          $photo->delete();
        }
        $tweet->delete();
        return redirect()->back()->with('success', 'Tweet Deleted');
    }

    // this method gets the feed and redirects to the feed page
    public function feed()
    {
        $user = Auth::user()->id;
        $f_id = Follow::where('user_id', Auth::user()->id)->get();
        $array = array();
        foreach ($f_id as $value) {
            array_push($array, $value->follow_id);
        }
        $tweets  = Tweets::whereIn('user_id', $array)->get();

        $names = users::whereIn('id', $array)->get();
        return view('feed', ['tweets' => $tweets, 'f_id' => $f_id, 'names' => $names]);
    }

    // this method gets the list that the current user is following
    public static function getFollowingList()
    {
      $user = Auth::user()->id;
      $f_id = Follow::where('user_id', Auth::user()->id)->get();
      $followingId = array();
      foreach ($f_id as $value) {
          array_push($followingId, $value->follow_id);
      }
      $followingArray = array();
      $names = users::whereIn('id', $followingId)->get();
      foreach ($names as $name) {
        array_push($followingArray, $name->name);
      }
      return $followingArray;
    }

    // this method gets the follower list
    public static function getFollowersList()
    {
      $user = Auth::user()->id;
      $f_id = Follow::where('follow_id', Auth::user()->id)->get();
      $followerId = array();
      foreach ($f_id as $value) {
          array_push($followerId, $value->user_id);
      }
      $followersArray = array();
      $names = users::whereIn('id', $followerId)->get();
      foreach ($names as $name) {
        array_push($followersArray, $name->name);
      }
      return $followersArray;
    }

    // this method shows the followers count
    public static function getFollowersCount()
    {
      $user = Auth::user()->id;
      $f_id = Follow::where('follow_id', Auth::user()->id)->get();
      return sizeof($f_id);
    }

    // this method gets the following count
    public static function getFollowingCount()
    {
      $user = Auth::user()->id;
      $f_id = Follow::where('user_id', Auth::user()->id)->get();
      return sizeof($f_id);
    }

    // this method show tweets with image
    public function show($id){
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view('photos.show')->with('photos', $user->photos);
    }
}
