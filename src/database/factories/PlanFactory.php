<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(\App\Plan::class, function (Faker $faker) {
    return [
        'name'       => $faker->name,
        'type'       => $faker->randomElement([\App\Plan::FREE, \App\Plan::MONETARY]),
        'is_default' => $faker->randomElement([1, 0]),
    ];
});
