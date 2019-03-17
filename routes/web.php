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

// welcome page
Route::get('/', function () {
    return view('welcome');
});

// feed page
Route::get('/feed','HomeController@feed');

// authenticate middleware
Auth::routes();

// return results of the search
Route::get('/search','SearchController@search');

// return other user prfile
Route::get('/searchOther/{id}','OtherUserController@searchOther');

// likes a tweet
Route::get('/like/{id}', 'LikeController@LikeTweet');

// edit biography
Route::post('/edit', 'HomeController@edit');

// add a profile image
Route::post('/edit',[
  'uses' => 'HomeController@addImage',
  'as' => 'account.save'
]);


Route::get('/edit/{filename}',[
  'uses' => 'HomeController@getUserImage',
  'as' => 'account.image'
]);
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/tweet', 'HomeController@create')->name('create');
Route::post('/delete/{id}', 'HomeController@delete')->name('delete');
Route::get('/follow/{id}', 'FollowController@Follow');

Route::resource('listings', 'ListingsController');


