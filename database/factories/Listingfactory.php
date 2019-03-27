<?php

use Faker\Generator as Faker;

$factory->define(App\Listing::class, function (Faker $faker)
{
    return [
        'user_id' =>  factory('App\User')->create()->id,
        'name' =>  $faker->name,
        'address' =>  $faker->address,
        'website' =>  $faker->url,
        'email' =>  $faker->unique()->email,
        'phone' =>  $faker->phoneNumber,
        'bio' =>  $faker->sentence,
    ];
});
