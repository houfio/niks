<?php

/** @var Factory $factory */

use Illuminate\Database\Eloquent\Factory;
use App\Asset;
use Faker\Generator as Faker;

$factory->define(Asset::class, function (Faker $faker) {
    return [
        'path' => 'https://placeimg.com/640/360/any'
    ];
});
