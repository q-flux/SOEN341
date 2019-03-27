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

class SearchTest extends TestCase
{
    use DatabaseMigrations;

    /** @test   
     * 
    */
    public function search_algorithm_test()
    {
        //Arrange
        $user = new User();
        $user->name = "testUser_searchAlgorithm_1";
        $user->email = "testUser_searchAlgorithm_1@mail.com";
        $user->password = "password";
        $user->save();
        $response = $this->call('GET', '/search', array("testUser"));

        //Assert
        $response->assertSuccessful();
    }

    /** @test 
    */
    public function search_other_user()
    {
        $user1 = factory(User::class)->create([
            'biography' => 'default biography'
        ]);
        $user2 = factory(User::class)->create([
            'biography' => 'default biography'
        ]);
        $this->actingAs($user1);
        $response = $this->call('GET', '/searchOther/' . $user2->id);
        $response->assertSuccessful();
    }
}
