<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Auth\User;
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

$factory->define(User::class, function (Faker $faker) {
    $username = $faker->username;
    $discriminator = $faker->unique()->randomNumber(4);
    $fullUsername = $username . "#" . $discriminator;
    return [
        'provider' => 'discord',
        'provider_id' => $faker->unique()->randomNumber(9) . $faker->unique()->randomNumber(9),
        'username' => $username,
        'discriminator' => $discriminator,
        'fullusername' => $fullUsername,
        'avatar' => 'https://placekitten.com/128/128',
        'email' => $faker->unique()->email,
        'email_verified' => $faker->boolean,
        'locale' => $faker->locale,
        'twofactor' => $faker->boolean,
        'admin' => true,
        'tos_accept' => true,
        'tos_accept_date' => \Carbon\Carbon::now(),
        'privacy_accept' => true,
        'privacy_accept_date' => \Carbon\Carbon::now(),
        'news_notifications' => true,
        'discord_notifications' => true,
        'internal_notifications' => true,
        'twitter' => null,
        'facebook' => null,
        'tribe_id' => null,
        'tribe_sees_dinos' => $faker->boolean,
        'remember_token' => Str::random(10),
    ];
});
