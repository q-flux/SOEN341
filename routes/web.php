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

// Welcome page
Route::get('/', function () {
    return view('welcome');
});

/** The following is a list of explanations for each route listed
*   /feed:                Feed page
*   /search:              Return results of the search
*   /searchOther:         Return other user profile
*   /like:                Likes a tweet
*   /edit:                Edit biography and photos
*   /home:                Returns the user's profile page
*   /tweet:               Creates a new tweet
*   /delete/id:           Deletes a tweet with specific id
*   /deletePhoto/id:      Delete a photo with specific id
*   /follow:              Follows a user with id
*   'listings':           Gets user's profile information
*   /home/Photos/create:  Used for creating an image
*   /home/Photos/store:   Used for storing an image
*   /home/id:             Used for getting the profile of specific user
*   /photos/id:           Used for getting specific photo id
*/

Route::get('/feed','HomeController@feed');

// Authenticate middleware
Auth::routes();

Route::get('/search','SearchController@search');

Route::get('/searchOther/{id}','OtherUserController@searchOther');

Route::get('/like/{id}', 'LikeController@LikeTweet');

Route::post('/edit', 'HomeController@edit');

Route::post('/edit',[
  'uses' => 'HomeController@addImage',
  'as' =>   'account.save'
]);

Route::get('/edit/{filename}',[
  'uses' => 'HomeController@getUserImage',
  'as' => 'account.image'
]);

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/tweet', 'HomeController@create')->name('create');

Route::post('/delete/{id}', 'HomeController@delete')->name('delete');

Route::post('/deletePhoto/{id}', 'HomeController@deletePhoto')->name('deletePhoto');

Route::get('/follow/{id}', 'FollowController@Follow');

Route::resource('listings', 'ListingsController');

Route::get('/home/Photos/create', 'PhotosController@create');

Route::post('/home/Photos/store', 'PhotosController@store');

Route::get('/home/{id}', 'HomeController@show');

Route::get('/photos/{id}', 'PhotosController@show');
