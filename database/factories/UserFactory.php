<?php

/** @var Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'phone_number' => $faker->phoneNumber,
        'zip_code' => $faker->postcode,
        'house_number' => $faker->buildingNumber,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => Hash::make('test123'),
        'remember_token' => Str::random(10),
        'is_approved' => $faker->boolean(75),
        'is_admin' => false,
        'motivation' => $faker->text(600)
    ];
});
