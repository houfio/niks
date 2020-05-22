<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Ticket;
use Faker\Generator as Faker;

$factory->define(Ticket::class, function (Faker $faker) {


    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'subject' => 'Onderwerp',
        'description' => $faker->text(250),
        'is_resolved' => false,
        'phone_number' => $faker->boolean(50) ? $faker->phoneNumber : null,
    ];
});
