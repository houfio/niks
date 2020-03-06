<?php

use App\Advertisement;
use App\User;
use App\Asset;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        factory(User::class, 10)->create()->each(function (User $user) {
            $user->advertisements()->saveMany(factory(Advertisement::class, 10)->make()->each(function (Advertisement $advertisement) {
                $advertisement->assets()->saveMany(factory(Asset::class, 3)->make());
            }));
        });
    }
}
