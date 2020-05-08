<?php

/** @var Factory $factory */

use App\Advertisement;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Advertisement::class, function (Faker $faker) {
    return [
        'title' => 'Taart bakken',
        'short_description' => 'Lekkere appeltaarten voor een lage prijs!',
        'long_description' => $faker->text(1200),
        'price' => $faker->numberBetween(1, 50),
        'enable_bidding' => $faker->boolean(50),
        'is_service' => $faker->boolean(50),
        'is_asking' => $faker->boolean(50)
    ];
});
