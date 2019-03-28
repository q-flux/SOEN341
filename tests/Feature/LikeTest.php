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

class LikeTest extends TestCase
{
    use DatabaseMigrations;



    /** @test
     *
     * This method test that an authorized user can like a tweet.
     * Namely, like item count in DB should be 1
     *
     * @return void
    */
    public function authenticated_user_can_get_like()
    {
        $user1 = factory(User::class)->create([
            'biography' => 'default biography'
        ]);

        $this->actingAs($user1);

        // if you have never liked it it will ilke it once
        $response = $this->call('GET', '/like/{2}');
        $response = $this->call('GET', '/like/{2}');
        $response = $this->call('GET', '/like/{2}');
        $this->assertEquals(1, Like::all()->count());
        $this->assertEquals(302, $response->status());
    }

    /** @test
     *
     * This method test that if you liked then disliked the same tweet, the liked item should be deleted from data base.
     * Namely, number of like item count should be 0
     *
     * @return void
    */
    public function authenticated_user_can_dislike_if_liked()
    {
        // create 1 user
        $user1 = factory(User::class)->create([
            'biography' => 'default biography'
        ]);

        // authorize the user
        $this->actingAs($user1);

        // user 1 likes the tweet 4 times
        $response = $this->call('GET', '/like/{2}');
        $response = $this->call('GET', '/like/{2}');
        $response = $this->call('GET', '/like/{2}');
        $response = $this->call('GET', '/like/{2}');


        // since you liked it, so if you like it again it will dislike, thus like item in the DB should be back to 0
        $this->assertEquals(0, Like::all()->count());;

        // if the like has been successful it is redirected
        $this->assertEquals(302, $response->status());
    }

    /** @test
      * This method tests that unauthorized user cannot like a tweet
      * @return void
     */
    public function unauthenticated_user_cannot_like()
    {
        $user1 = factory(User::class)->create([
            'biography' => 'default biography'
        ]);

        $response = $this->call('GET', '/like/{2}');

        $this->assertEquals(0, Like::all()->count());;
        // permission error
        $this->assertEquals(500, $response->status());
    }
}
