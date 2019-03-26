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

}
