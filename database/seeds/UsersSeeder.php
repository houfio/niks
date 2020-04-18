<?php

use App\Advertisement;
use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        factory(User::class, 5)->create();

        $approvedUsers = factory(User::class, 5)->create([
            'is_approved' => true
        ])->each(function (User $user) {
            $user->advertisements()->saveMany(factory(Advertisement::class, 10)->make());
        });

        $advertisements = Advertisement::all();

        $approvedUsers->each(function (User $user) use ($advertisements) {
            $user->favorites()->saveMany($advertisements->random(rand(1, 4)));
        });

        factory(User::class, 5)->create([
            'is_admin' => true,
            'is_approved' => true
        ])->each(function (User $user) {
            $user->advertisements()->saveMany(factory(Advertisement::class, 5)->make());
        });
    }
}
