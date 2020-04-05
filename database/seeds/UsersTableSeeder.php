<?php

use App\Advertisement;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        factory(User::class, 10)->create()->each(function (User $user) {
            if($user->is_approved) {
                $user->advertisements()->saveMany(factory(Advertisement::class, 10)->make());
            }
        });
    }
}
