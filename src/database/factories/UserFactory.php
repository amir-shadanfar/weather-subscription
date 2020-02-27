<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Hash;
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

$factory->define(User::class, function (Faker $faker) {

    $plan = \App\Plan::inRandomOrder()->first();
    $giftCode = \App\GiftCode::inRandomOrder()->first();
    $city = \App\City::inRandomOrder()->first();

    return [
        'name'             => $faker->name,
        'email'            => $faker->email,
        'password'         => Hash::make('123456'),
        'language'         => $faker->languageCode,
        'timezone'         => $faker->timezone,
        'operating_system' => $faker->randomElement(['mac', 'windows', 'linux']),
        'access_token'     => Str::random(10),
        'plan_id'          => !is_null($plan) ? $plan->id : factory(\App\Plan::class)->create()->id,
        'gift_code_id'     => !is_null($giftCode) ? $giftCode->id : factory(\App\GiftCode::class)->create()->id,
        'city_id'          => !is_null($city) ? $city->id : factory(\App\City::class)->create()->id,
    ];
});
