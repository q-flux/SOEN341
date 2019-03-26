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



    /** @test 
     * 
     * This method test that an authorized user can like a tweet.
     * Namely, like item count in DB should be 1
    */
    public function authenticated_user_can_get_like()
    {
        $user1 = factory(User::class)->create([
            'biography' => 'default biography'
        ]);

        $this->actingAs($user1);

         // if you have never liked it it will ilke it once
        $response = $this->call('GET', '/like/{2}'); 
        $response = $this->call('GET', '/like/{2}'); 
        $response = $this->call('GET', '/like/{2}'); 
        $this->assertEquals(1, Like::all()->count());
        $this->assertEquals(302, $response->status());

    }

    /** @test 
     * 
     * This method test that if you liked then disliked the same tweet, the like item should be deleted from DB.
     * Namely, number of like item count should be 0
    */
    public function authenticated_user_can_dislike_if_liked()
        {
            $user1 = factory(User::class)->create([
                'biography' => 'default biography'
            ]);
    
            $this->actingAs($user1);
    
            $response = $this->call('GET', '/like/{2}');
            $response = $this->call('GET', '/like/{2}');
            $response = $this->call('GET', '/like/{2}');
            $response = $this->call('GET', '/like/{2}');
        
            
            // since you liked it, so if you like it again it will dislike
            $this->assertEquals(0, Like::all()->count());;
            $this->assertEquals(302, $response->status());
    
        }

    /** @test 
     * 
     * This method checks that if 3 user likes a tweet, 3 like item should be inserted to DB
    */
    public function testing_for_correct_number_of_like_for_a_tweet1()
    {

        $tweetID = 2;
        $user1 = factory(User::class)->create([
            'biography' => 'default biography'
        ]);
        $user2 = factory(User::class)->create([
            'biography' => 'default biography'
        ]);
        $user3 = factory(User::class)->create([
            'biography' => 'default biography'
        ]);

        $this->actingAs($user1);
        $response = $this->call('GET', '/like/{'.$tweetID.'}');
        
        $this->actingAs($user2);
        $response = $this->call('GET', '/like/{'.$tweetID.'}');
        
        $this->actingAs($user3);
        $response = $this->call('GET', '/like/{'.$tweetID.'}');
            
        
        // 3 different user has liked the tweet so there should be 3 items in the table
        $this->assertEquals(3, Like::all()->count());;
        $this->assertEquals(302, $response->status());

    }

      /** @test 
       * 
       * This method tests that if a user A and user B likes the same tweet and user A dislikes it, correct like item should be kept.
       * Namely, there should only be 1 like item left
      */
      public function testing_for_correct_number_of_likes_for_a_tweet2()
      {
  
          $tweetID = 2;
          $user1 = factory(User::class)->create([
              'biography' => 'default biography'
          ]);
          $user2 = factory(User::class)->create([
              'biography' => 'default biography'
          ]);
  
          $this->actingAs($user1);
          $response = $this->call('GET', '/like/{'.$tweetID.'}');
          
          $this->actingAs($user2);
          $response = $this->call('GET', '/like/{'.$tweetID.'}');
          
          
          $response = $this->call('GET', '/like/{'.$tweetID.'}');              
          
          // 1 user liked and disliked it, other user has liked it once
          $this->assertEquals(1, Like::all()->count());
          $this->assertEquals(302, $response->status());
  
      }

     /** @test 
      * This method tests that unauthorized user cannot like a tweet
     */
     public function unauthenticated_user_cannot_like()
     {
         $user1 = factory(User::class)->create([
             'biography' => 'default biography'
         ]);
  
         $response = $this->call('GET', '/like/{2}');

         $this->assertEquals(0, Like::all()->count());;
         // permission error
         $this->assertEquals(500, $response->status());
     }
}
