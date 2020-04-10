<?php

use App\Advertisement;
use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        factory(User::class, 9)->create()->each(function (User $user) {
            if ($user->is_approved) {
                $user->advertisements()->saveMany(factory(Advertisement::class, 10)->make());
            }
        });

        factory(User::class, 5)->create([
            'is_admin' => true,
            'is_approved' => true
        ])->each(function (User $user) {
            $user->advertisements()->saveMany(factory(Advertisement::class, 5)->make());
        });
    }
}
