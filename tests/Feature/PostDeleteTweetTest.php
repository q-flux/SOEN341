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



    /** @test */
    public function authenticated_user_can_post_tweet()
    {

        $user = factory(User::class)->create([
            'biography' => 'default biography'
        ]);

        $this->actingAs($user);

        $tweet = ['tweet' => 'hello'];

        $response = $this->call('POST', '/tweet', $tweet);

        $this->assertEquals(1, Tweets::all()->count());
    }

    /** @test */
    public function unauthenticated_user_is_redirected_to_login_when_tweeting()
    {

        $tweet = ['tweet' => 'hello'];

        $response = $this->call('POST', '/tweet', $tweet);

        $this->assertEquals(302, $response->status());

        $response->assertRedirect(
            '/login'
        );
    }

    /** @test */
    public function unauthenticated_user_cannot_post_tweet()
    {
        $tweet = ['tweet' => 'hello'];

        $response = $this->call('POST', '/tweet', $tweet);

        $this->assertEquals(0, Tweets::all()->count());
    }

    /** @test */
    public function authenticated_user_delete_tweet()
    {
        $user = factory(User::class)->create([
            'biography' => 'sdefault biography'
        ]);

        $this->actingAs($user);

        $tweet = ['tweet' => 'hello'];

        $response = $this->call('POST', '/tweet', $tweet);

        $this->assertEquals(1, Tweets::all()->count());

        $responseDelete = $this->call('POST', '/delete/' . $user->id);

        $this->assertEquals(302, $responseDelete->status());

        $this->assertEquals(0, Tweets::all()->count());
    }
}
