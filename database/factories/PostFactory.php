<?php

/** @var Factory $factory */

use App\Post;
use App\User;
use Illuminate\Database\Eloquent\Factory;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $postDate = $faker->dateTimeBetween('-6 months', 'now');
    $poster = User::where('is_approved', 1)->where('is_admin', 1)->get()->random();

    return [
        'title' => 'Nieuwsbericht van ' . Carbon::parse($postDate)->format('d-m-Y'),
        'content' => $faker->text(300),
        'author_id' => $poster->id,
        'created_at' => $postDate
    ];
});
