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



    /** @test */
    public function authenticated_user_can_get_like()
    {
        $user1 = factory(User::class)->create([
            'biography' => 'default biography'
        ]);

        $this->actingAs($user1);

        $response = $this->call('GET', '/like/{2}');
        $response->assertRedirect(
            '/'
        );
        $this->assertEquals(302, $response->status());
    }
}
