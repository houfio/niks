<?php

/** @var Factory $factory */

use App\Bid;
use Illuminate\Database\Eloquent\Factory;
use Faker\Generator as Faker;

$factory->define(Bid::class, function (Faker $faker) {
    return [
        'bid' => $faker->numberBetween(1, 30)
    ];
});
