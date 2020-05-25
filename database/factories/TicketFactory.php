<?php

/** @var Factory $factory */

use Illuminate\Database\Eloquent\Factory;
use App\Ticket;
use Faker\Generator as Faker;

$factory->define(Ticket::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'subject' => 'Onderwerp',
        'description' => $faker->text(250),
        'is_resolved' => false
    ];
});
