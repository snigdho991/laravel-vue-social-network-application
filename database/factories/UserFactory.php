<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
	$bind = '11 OCT 1995';
    $convert = strtotime($bind);
    $dob = date("Y-m-d H:i:s", $convert);

    return [
        'firstname' => $faker->firstname,
        'lastname'  => $faker->lastname,
        'dob'       => $dob,
        'gender'    => 0,
        'avatar'    => 'public/defaults/avatar/female.png',
        'city'      => $faker->city,
        'country'   => $faker->country,
        'cover'     => 'public/covers/static/cover.gif',
        'email' => $faker->unique()->safeEmail,
        'slug' => str_slug($faker->name),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Message::class, function (Faker $faker) {
    
    do {
        $from = rand(1, 5);
        $to = rand(1, 5);
    } while ($from === $to);

    return [
        'from' => $from,
        'to'  => $to,
        'text' => $faker->sentence,
    ];
});
