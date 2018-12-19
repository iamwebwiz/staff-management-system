<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});





$factory->define(App\Staff::class, function (Faker\Generator $faker) {

    $levels = ['Intern', 'Junior', 'Senior', 'Supervisor', 'Manager'];

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'age' => $faker->randomNumber(),
        'phone' => $faker->phoneNumber,
        'image' => $faker->imageUrl(),
        'address' => $faker->address,
        'city' => $faker->city,
        'state' => $faker->city,
        'country' => $faker->country,
        'level' => $levels[rand(0,4)],
    ];
});
