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

$factory->define(App\Animal::class, function (Faker $faker) {
    return [
        'name_full' => $faker->name,
        'id_number' => $faker->unique()->randomNumber(8),
        'category' => $faker->randomElement($array = ['adoption', 'breeding']),
        'date_of_birth' => $faker->date($format = 'Y-m-d'),
        'sex' => $faker->randomElement($array = ['male', 'female']),
        'team_id' => '14'
    ];
});
