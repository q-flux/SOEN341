<?php

use Faker\Generator as Faker;

$factory->define(App\Tweets::class, function (Faker $faker) {
    return [
        'user_id' =>  factory('App\User')->create()->id,
        'tweet_text' =>  $faker->sentence,
        'time_posted' => now(),
        'like_cnt' => 3,
        'reply_cnt' => 3
    ];
});
