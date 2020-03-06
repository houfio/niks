<?php

/** @var Factory $factory */

use Illuminate\Database\Eloquent\Factory;
use App\PasswordReset;
use Faker\Generator as Faker;

$factory->define(PasswordReset::class, function (Faker $faker) {
    return [
        'email' => $faker->email,
        'token' => $faker->regexify('[A-Za-z0-9]{64}')
    ];
});
