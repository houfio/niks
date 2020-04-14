<?php

use App\Advertisement;
use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        // 5 unapproved users
        factory(User::class, 5)->create();

        // 5 approved users
        factory(User::class, 5)->create([
            'is_approved' => true
        ])->each(function (User $user) {
            $user->advertisements()->saveMany(factory(Advertisement::class, 10)->make());
        });

        // 5 admins
        factory(User::class, 5)->create([
            'is_admin' => true,
            'is_approved' => true
        ])->each(function (User $user) {
            $user->advertisements()->saveMany(factory(Advertisement::class, 5)->make());
        });
    }
}
