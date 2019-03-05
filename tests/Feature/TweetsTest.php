<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Session;
use App\Tweets;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TweetsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function authenticated_user_can_go_to_home()
    {
        //Given we have an authenticated user
        $user = factory(User::class)->create();

        $this->actingAs($user);
        
        //testing home route
        $response = $this->call('GET', '/home');

        $this->assertEquals(200, $response->status());
    }

    /** @test */
    public function authenticated_user_can_get_like()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->call('GET', '/like');

        $this->assertEquals(200, $response->status());
            
    }

    /** @test */
    public function authenticated_user_can_post_tweet()
    {

        // Session::start;
        //Given we have an authenticated user
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $tweet = factory('App\Tweets',6)->create();

        $response = $this->call('POST', '/create', $tweet->toArray());
        
        $this->assertEquals(6, Tweets::all()->count());
        
    }
}

