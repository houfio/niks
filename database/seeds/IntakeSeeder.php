<?php

use App\Intake;
use App\User;
use Illuminate\Database\Seeder;

class IntakeSeeder extends Seeder
{
    public function run()
    {
        $admins = User::where('is_admin', true)->where('is_approved', true)->get()->toArray();
        if(count($admins) == 0) {
            return;
        }
        $admin = $admins[array_rand($admins)];

        $pendingUsers = User::where('is_approved', false)->get();
        if(count($pendingUsers) == 0) {
            return;
        }

        $pendingUsers->each(function(User $pendingUser) use ($admin) {
            factory(Intake::class)->create([
                'inviter_id' => $admin['id'],
                'invitee_id' => $pendingUser->id
            ]);
        });
    }
}
