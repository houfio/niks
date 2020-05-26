<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Transaction;
use App\User;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
    $sender = User::where('is_approved', 1)->get()->random();
    $receiver = User::has('advertisements')->get()->random();
    $transactionDate = $faker->dateTimeBetween('-6 months', 'now');

    return [
        'amount' => $faker->numberBetween(1, 40),
        'receiver_id' => $receiver->id,
        'sender_id' => $sender->id,
        'created_at' => $transactionDate
    ];
});
