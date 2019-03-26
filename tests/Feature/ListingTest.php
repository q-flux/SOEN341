<?php

namespace Tests\Feature;
use App\Listing;
use App\User;
use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseMigrations;

class ListingTest extends TestCase
{

    use DatabaseMigrations;

    function test_users_can_store_their_profile_information(){

    	$user = factory(User::class)->create([
            'biography' => 'default biography'
        ]);

        $this->actingAs($user);

        $profile = [
                'name' => "kasra",
                'website' => "www.google.com",
                'email' => "kasral89@gmail.com",
                'phone' => "4384925014",
                'address' => "Montreal",
                'bio' => "For testing",
                ];
     
        $response = $this->call('POST', '/listings', $profile);

        $this->assertEquals(1, Listing::all()->count());
    }

    public function unauthenticated_user_cannot_post_listing()
    {

        $profile = [
                'name' => "kasra",
                'website' => "www.google.com",
                'email' => "kasral89@gmail.com",
                'phone' => "4384925014",
                'address' => "Montreal",
                'bio' => "For testing",
                ];

        $response = $this->call('POST', '/listings', $profile);

        $this->assertEquals(0, Listing::all()->count());
    }

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

        $response = $this->call('PUT', '/listings/'.$profile2->id, $profile1);
        $response->assertStatus(302);
        $this->assertDatabaseHas('listings', ['name' => 'kasra']);
        $this->assertDatabaseMissing('listings', ['name' => 'Rodrick']);
    }

}
