<?php
use App\Tweets;
use Illuminate\Http\Request;
use Request as RequestFacade;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', function(Request $request){
//     // $tweets = Tweets::where("user_id", Auth::user()->id)->get();
//     // return $tweets;

//     $tweets = Tweets::orderBy('time_posted', 'asc')->get();
//     return view('home', [
//         'tweets' => $tweets
//     ]);
    
// });

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/tweet', function (Request $request) {
    // $validator = Validator::make($request->all(), [
    //     'tweet' => 'required|max:255',
    // ]);

    // if ($validator->fails()) {
    //     return redirect('/home')
    //         ->withInput()
    //         ->withErrors($validator);
    // }

    // Create The Tweet...
    $tweet = new Tweets;
    $tweet->user_id = Auth::user()->id;
    $tweet->tweet_text = $request->tweet;

    $tweet->save();

    return redirect('/home');
});
Route::delete('/home/{id}', function ($id) {
    //
});
