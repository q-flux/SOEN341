<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Tweets;
use App\User;
use App\Follow;
use App\Like;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FollowingTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function authenticated_user_can_follow()
    {
        $user1 = factory(User::class)->create([
            'biography' => 'default biography'
        ]);

        $this->actingAs($user1);

        // if you have never liked it it will ilke it once
        $response = $this->call('GET', '/follow/{2}');
        $this->assertEquals(1, Follow::all()->count());
        $this->assertEquals(302, $response->status());
    }

    /** @test */
    public function authenticated_user_can_unfollow_if_already_following()
    {
        $user1 = factory(User::class)->create([
            'biography' => 'default biography'
        ]);

        $this->actingAs($user1);

        $response = $this->call('GET', '/follow/{2}');
        $response = $this->call('GET', '/follow/{2}');

        // since you liked it, so if you like it again it will dislike
        $this->assertEquals(0, Follow::all()->count());;
        $this->assertEquals(302, $response->status());
    }

    /** @test */
    public function unauthenticated_user_cannot_follow()
    {
        $user1 = factory(User::class)->create([
            'biography' => 'default biography'
        ]);

        $response = $this->call('GET', '/follow/{2}');

        // permission error
        $this->assertEquals(500, $response->status());
    }

    /** @test 
     * 
     * This method checks that if 3 user follows one tweet, 3 follow item should be inserted to DB
    */
    public function testing_for_correct_number_of_follows_for_a_tweet1()
    {

        $userID = 2;
        $user1 = factory(User::class)->create([
            'biography' => 'default biography'
        ]);
        $user2 = factory(User::class)->create([
            'biography' => 'default biography'
        ]);
        $user3 = factory(User::class)->create([
            'biography' => 'default biography'
        ]);

        $this->actingAs($user1);
        $response = $this->call('GET', '/follow/{' . $userID . '}');

        $this->actingAs($user2);
        $response = $this->call('GET', '/follow/{' . $userID . '}');

        $this->actingAs($user3);
        $response = $this->call('GET', '/follow/{' . $userID . '}');


        // 3 different user has followed the tweet so there should be 3 items in the table
        $this->assertEquals(3, Follow::all()->count());;
        $this->assertEquals(302, $response->status());
    }

    /** @test 
       * 
       * This method tests that if a user A and user B follows the same tweet and user A dislikes it, correct follow item should be kept.
       * Namely, there should only be 1 follow item left in DB
      */
    public function testing_for_correct_number_of_follows_for_a_tweet2()
    {

        $userID = 2;
        $user1 = factory(User::class)->create([
            'biography' => 'default biography'
        ]);
        $user2 = factory(User::class)->create([
            'biography' => 'default biography'
        ]);

        $this->actingAs($user1);
        $response = $this->call('GET', '/follow/{' . $userID . '}');

        $this->actingAs($user2);
        $response = $this->call('GET', '/follow/{' . $userID . '}');


        $response = $this->call('GET', '/follow/{' . $userID . '}');

        // 1 user liked and disliked it, other user has liked it once
        $this->assertEquals(1, Follow::all()->count());
        $this->assertEquals(302, $response->status());
    }

}
