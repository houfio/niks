<?php

use App\Intake;
use App\User;
use Illuminate\Database\Seeder;

class IntakeSeeder extends Seeder
{
    public function run()
    {
        $admins = User::where('is_admin', true)->get();
        $users = User::where('is_approved', false)->get();

        factory(Intake::class, 5)->make()->each(function (Intake $intake) use ($admins, $users) {
            $intake->invitee()->associate($users->random());
            $intake->inviter()->associate($admins->random())->save();
        });
    }
}
