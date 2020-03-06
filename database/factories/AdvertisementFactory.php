<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Advertisement;
use Faker\Generator as Faker;

$factory->define(Advertisement::class, function (Faker $faker) {
    return [
        'title' => 'Taart bakken',
        'short_description' => $faker->text(60),
        'long_description' => $faker->text(1200),
        'price' => $faker->numberBetween(0, 50),
        'enable_bidding' => $faker->boolean,
    ];
});
