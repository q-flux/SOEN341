<?php

namespace Tests\Feature;
use App\Listing;
use App\User;
use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseMigrations;

class ListingTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * @test
     * 
     * this method test for the fact that authorized user can store their profile information
     * 
     * @return void
     */
    function test_users_can_store_their_profile_information(){

        // create a dummy user
    	$user = factory(User::class)->create([
            'biography' => 'default biography'
        ]);

        // authorize the user
        $this->actingAs($user);

        // dummy profile information
        $profile = [
                'name' => "kasra",
                'website' => "www.google.com",
                'email' => "kasral89@gmail.com",
                'phone' => "4384925014",
                'address' => "Montreal",
                'bio' => "For testing",
                ];
     

        // call the route that handles the posting of profile
        $response = $this->call('POST', '/listings', $profile);

        // since a user has updated their profile information there should be 1 list item in DB
        $this->assertEquals(1, Listing::all()->count());
    }

    /**
     * @test
     * 
     * unauthenticated user cannot post their profile information
     * 
     * @return void
     */
    public function unauthenticated_user_cannot_post_listing()
    {
        // dummy profile information
        $profile = [
                'name' => "kasra",
                'website' => "www.google.com",
                'email' => "kasral89@gmail.com",
                'phone' => "4384925014",
                'address' => "Montreal",
                'bio' => "For testing",
                ];

        $response = $this->call('POST', '/listings', $profile);
        
        // since user is not authorized he cannot update his profile, thus listing item in DB is 0
        $this->assertEquals(0, Listing::all()->count());
    }

    /**
     * @test
     * 
     * this method tests that the user can edit their profile information
     * 
     * @return void
     */
    public function test_users_can_edit_their_profile_information()
    {
        $user = factory(User::class)->create([
            'biography' => 'default biography'
        ]);

        $this->actingAs($user);

        $profile1 = [
                'name' => "kasra",
                'website' => "www.google.com",
                'email' => "kasral89@gmail.com",
                'phone' => "4384925014",
                'address' => "Montreal",
                'bio' => "For testing",
                ];

        $profile2 = factory(Listing::class)->create([
            'name' => 'Rodrick'
        ]);

        $this->assertDatabaseHas('listings', ['name' => 'Rodrick']);

        // you are storing listing information
        $response = $this->call('PUT', '/listings/'.$user->id, $profile1);
        $response->assertStatus(302);
        $this->assertDatabaseHas('listings', ['name' => 'kasra']);  
        $this->assertDatabaseMissing('listings', ['name' => 'Rodrick']);
    }

}
