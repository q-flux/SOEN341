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
//Route::get('/feed', function ()
// {
//  return view('feed');
//});
Route::get('/feed','HomeController@feed');
Auth::routes();
Route::get('/search','SearchController@search');
Route::get('/searchOther','OtherUser@searchOther');

Route::get('/like', 'LikeController@LikeTweet');
// Route::get('search');
//Route::get('/home','HomeController@feed')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/tweet', 'HomeController@create')->name('create');
Route::post('/delete/{id}', 'HomeController@delete')->name('delete');
/*Route::post('/like', [
    'uses' => 'TweetController@LikeTweet',
  'as' => 'like'
]);*/

// Route::delete('/home/{id}', function ($id) {
