<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Ticket;
use Faker\Generator as Faker;

$factory->define(Ticket::class, function (Faker $faker) {
    $subjects = [
        'Suggestie',
        'Probleem melden',
        'Vraag',
        'Overig'
    ];
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'subject' => $subjects[array_rand($subjects, 1)],
        'description' => $faker->text(250)
    ];
});
