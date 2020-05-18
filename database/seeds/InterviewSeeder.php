<?php

use App\Interview;
use App\User;
use Illuminate\Database\Seeder;

class InterviewSeeder extends Seeder
{
    public function run()
    {
        $admins = User::where('is_admin', true)->get();
        $users = User::where('is_approved', false)->get();

        factory(Interview::class, 5)->make()->each(function (Interview $interview) use ($admins, $users) {
            $interview->invitee()->associate($users->random());
            $interview->inviter()->associate($admins->random())->save();
        });
    }
}
