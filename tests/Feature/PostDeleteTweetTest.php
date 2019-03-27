<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Tweets;
use App\User;
use App\Like;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PostDeleteTweetTest extends TestCase
{
    use DatabaseMigrations;



    /** @test 
     * 
     * this method tests that authenticated user can post a tweet
     * 
     * @return void
    */
    public function authenticated_user_can_post_tweet()
    {

        $user = factory(User::class)->create([
            'biography' => 'default biography'
        ]);

        $this->actingAs($user);

        $tweet = ['tweet' => 'hello'];

        $response = $this->call('POST', '/tweet', $tweet);

        // tweet count should be 1
        $this->assertEquals(1, Tweets::all()->count());
    }

    /** @test 
     * this method tests that unauthenticated user cannot post a tweet and is redirected to login
     * 
     * @return void
    */
    public function unauthenticated_user_is_redirected_to_login_when_tweeting()
    {

        $tweet = ['tweet' => 'hello'];

        $response = $this->call('POST', '/tweet', $tweet);

        $this->assertEquals(302, $response->status());

        $response->assertRedirect(
            '/login'
        );
    }

    /** @test
     * this method checks that unauthenticated user cannot post a tweet so tweet count should be 0
     * 
     * @return void
     */
    public function unauthenticated_user_cannot_post_tweet()
    {
        $tweet = ['tweet' => 'hello'];

        $response = $this->call('POST', '/tweet', $tweet);

        $this->assertEquals(0, Tweets::all()->count());
    }

    /** @test 
     * 
     * this method tests that authenticated user can delete tweet
     * 
     * @return void
     * 
    */
    public function authenticated_user_delete_tweet()
    {
        $user = factory(User::class)->create([
            'biography' => 'sdefault biography'
        ]);

        $this->actingAs($user); // user1 is authorized

        $tweetID = '1'; // this autoincrementedID in DB
        $tweet = ['tweet' => 'hello'];
        
        $response = $this->call('POST', '/tweet', $tweet);

        $this->assertEquals(1, Tweets::all()->count());

        $responseDelete = $this->call('POST', '/delete/'.$tweetID);

        $this->assertEquals(302, $responseDelete->status());
        // tweet count should be 0 after delete
        $this->assertEquals(0, Tweets::all()->count());

    }
}
