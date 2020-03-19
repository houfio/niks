<?php

namespace Tests\Browser;

use App\Advertisement;
use App\Bid;
use App\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class FormInvalidBidTest extends DuskTestCase
{
    /**
     * @test
     * @throws Throwable
     */
    public function testInvalidBidTest()
    {
        $owner = factory(User::class)->create([
            'is_approved' => true
        ]);

        $user = factory(User::class)->create([
            'is_approved' => true
        ]);

        /** @var Advertisement $advertisement */
        $advertisement = factory(Advertisement::class)->make([
            'enable_bidding' => true,
            'minimum_price' => 4,
            'price' => null
        ]);

        $advertisement->user()->associate($owner)->save();

        /** @var Bid $bid */
        $bid = factory(Bid::class)->make([
            'bid' => 5
        ]);

        $bid->user()->associate($user);
        $bid->advertisement()->associate($advertisement)->save();
        $advertisement->bids()->save($bid);

        $this->browse(function (Browser $browser) use ($advertisement, $user) {
            $browser->loginAs($user)
                ->visit("/advertisements/$advertisement->id")
                ->type('bid', 4)
                ->press('place_bid');
        });

        $this->assertDatabaseMissing('bids', [
            'user_id' => $user->id,
            'advertisement_id' => $advertisement->id,
            'bid' => 4
        ]);
    }
}
