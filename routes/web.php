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
  'as' =>   'account.save'
]);

Route::get('/edit/{filename}',[
  'uses' => 'HomeController@getUserImage',
  'as' => 'account.image'
]);

// returns the user's profile page
Route::get('/home', 'HomeController@index')->name('home');

// creates a new tweet 
Route::post('/tweet', 'HomeController@create')->name('create');

// deletes a tweet with specific id
Route::post('/delete/{id}', 'HomeController@delete')->name('delete');

// delete a photo with specific id
Route::post('/deletePhoto/{id}', 'HomeController@deletePhoto')->name('deletePhoto');

// follows a user with id
Route::get('/follow/{id}', 'FollowController@Follow');

// gets user's profile information
Route::resource('listings', 'ListingsController');

// used for creating an image
Route::get('/home/Photos/create', 'PhotosController@create');

// used for storing an image
Route::post('/home/Photos/store', 'PhotosController@store');

// used for getting the profile of specific user
Route::get('/home/{id}', 'HomeController@show');

// used for getting specific photo id
Route::get('/photos/{id}', 'PhotosController@show');
