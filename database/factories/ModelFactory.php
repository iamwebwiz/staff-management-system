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
        'age' => $faker->randomNumber(),
        'phone' => $faker->phoneNumber,
        'image' => $faker->imageUrl(),
        'address' => $faker->address,
        'city' => $faker->city,
        'state' => $faker->city,
        'country' => $faker->country,
        'level' => $levels[rand(1,4)],
        'user_id' => \App\User::first()->id,
        'start_work_date' => $faker->date(),
    ];
});


$factory->define(App\Payroll::class, function (Faker\Generator $faker) {

    $percentage = rand(1,10);
    $gross_salary = $faker->numberBetween(10000, 14500);

    return [
        'staff_id' => \App\Staff::all()->random()->id,
        'gross_salary' => $gross_salary,
        'tax_percentage' => $percentage,
        'net_salary' => (1 - ($percentage / 100)) *$gross_salary,
        'month' => $faker->monthName,
        'year' => $faker->year(),
        'comment' => $faker->sentence,
    ];

});




$factory->define(App\StaffLeave::class, function (Faker\Generator $faker) {
    return [
        'staff_id' => \App\Staff::all()->random()->id,
        'reason_for_leave' => $faker->paragraph,
        'leave_start_date' => $faker->dateTimeThisMonth('-1 week'),
        'leave_end_date' => $faker->dateTimeThisMonth,
        'is_approved' => $faker->boolean,
    ];
});