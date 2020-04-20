<?php

/** @var Factory $factory */

use App\Intake;
use Illuminate\Database\Eloquent\Factory;
use Faker\Generator as Faker;

$factory->define(Intake::class, function (Faker $faker) {
    return [
        'date' => $faker->dateTimeBetween('+1 days', '+6 months'),
        'accepted' => $faker->boolean,
        'token' => md5(uniqid('', true))
    ];
});
