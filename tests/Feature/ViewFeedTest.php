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

class ViewFeedTest extends TestCase
{
    use DatabaseMigrations;

    /** @test 
     * 
     * 
     * @return void
      */
    public function authenticated_user_can_view_feed()
    {
        $user = factory(User::class)->create([
            'biography' => 'default biography'
        ]);

        $this->actingAs($user);
        $response  = $this->get('/feed');
        $this->assertEquals(200, $response->status());
    }

    /** @test 
     *
     * 
     * @return void
      */
    public function unauthenticated_user_can_view_feed()
    {
        $user = factory(User::class)->create([
            'biography' => 'default biography'
        ]);

        $response  = $this->get('/feed');
        $this->assertNotEquals(200, $response->status());
    }
}
