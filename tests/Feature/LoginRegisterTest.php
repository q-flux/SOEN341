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

class LoginRegisterTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function test_user_can_view_a_login_form()
    {
        $response = $this->get('/login');
        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    /** @test */
    public function test_user_can_view_a_register_form()
    {
        $response = $this->get('/register');
        $response->assertSuccessful();
        $response->assertViewIs('auth.register');
    }

    /** @test */
    public function test_user_cannot_login_with_incorrect_password()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('i-love-laravel'),
            'biography' => 'default biography'
        ]);

        $response = $this->from('/login')->post('/login', [
            'email' => $user->email,
            'password' => 'invalid-password',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    /** @test */
    public function test_user_cannot_view_a_login_form_when_authenticated()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get('/login');
        $response->assertRedirect('/home');
    }

    /** @test */
    public function authenticated_user_can_go_to_home()
    {
        //Given we have an authenticated user
        $user = factory(User::class)->create([
            'biography' => 'default biography'
        ]);
        $this->actingAs($user);

        //testing home route
        $response = $this->call('GET', '/home');

        $this->assertEquals(200, $response->status());
    }

    /** @test */
    public function unauthenticated_user_returned_to_login()
    {

        //testing home route
        $response = $this->call('GET', '/home');

        $this->assertEquals(302, $response->status());

        $response->assertRedirect(
            '/login'
        );
    }
}
