<?php

use App\Advertisement;
use App\Bid;
use App\User;
use Illuminate\Database\Seeder;

class BidsSeeder extends Seeder
{
    public function run()
    {
        $advertisements = Advertisement::where('enable_bidding', true)->get();
        $users = User::where('is_approved', true)->get();

        factory(Bid::class, 60)->make()->each(function (Bid $bid) use ($users, $advertisements) {
            $bid->user()->associate($users->random());
            $bid->advertisement()->associate($advertisements->random())->save();
        });
    }
}
