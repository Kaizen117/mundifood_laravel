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
    return [
        'name' => $faker->name,
        'surname1'=> $faker->lastname,
        'surname2'=> $faker->lastname,
        'telephone' => $faker->numerify('#########'),
        'address' => $faker->address(150),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'username' => $faker->username,
        'password' => bcrypt('laravel'),
        'type'=>'users',
        'activated'=> false,
        'remember_token' => str_random(20),
    ];
});
