<?php

namespace Tests\Browser\Bid;

use App\Advertisement;
use App\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class FormSuccessfulBidTest extends DuskTestCase
{
    /**
     * @test
     * @throws Throwable
     */
    public function testSuccessfulBid()
    {
        $owner = factory(User::class)->create([
            'is_approved' => true
        ]);

        $user = factory(User::class)->create([
            'is_approved' => true
        ]);

        $advertisement = factory(Advertisement::class)->create([
            'enable_bidding' => true,
            'minimum_price' => 4,
            'price' => null,
            'user_id' => $owner->id
        ]);

        $this->browse(function (Browser $browser) use ($advertisement, $user) {
            $browser->loginAs($user)
                ->visit("/advertisements/$advertisement->id")
                ->type('bid', 5)
                ->press('place_bid');
        });

        $this->assertDatabaseHas('bids', [
            'user_id' => $user->id,
            'advertisement_id' => $advertisement->id,
            'bid' => 5
        ]);
    }
}
