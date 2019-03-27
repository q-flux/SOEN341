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

    /** @test
     * 
     * this method tests that user can view a login form
     * @return void
     */
    public function test_user_can_view_a_login_form()
    {
        $response = $this->get('/login');
        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    /** @test
     * this method tests that user can view register form 
     * 
     * @return void
     */
    public function test_user_can_view_a_register_form()
    {
        $response = $this->get('/register');
        $response->assertSuccessful();
        $response->assertViewIs('auth.register');
    }

    /** @test 
     * this method tests that user cannot login with incorrect password
     * 
     * @return void
    */
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

    /** @test
     * 
     * this method tests that user cannot view login form when authenticated
     * 
     * @return void
     */
    public function test_user_cannot_view_a_login_form_when_authenticated()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get('/login');
        $response->assertRedirect('/home');
    }

    /** @test 
     * this method tests that authenticated user is taken to the home page 
     * 
     * @return void
    */
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

    /** @test 
     * 
     * this method tests that unauthenticated user cannot go to home page (redirected to login)
     * 
     * @return void
    */
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
