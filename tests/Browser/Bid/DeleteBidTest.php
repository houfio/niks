<?php

namespace Tests\Browser\Bid;

use App\Advertisement;
use App\Bid;
use App\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class DeleteBidTest extends DuskTestCase
{
    /**
     * @test
     * @throws Throwable
     */
    public function testDeleteBid()
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

        /** @var Bid $bid */
        $bid = factory(Bid::class)->make([
            'bid' =>  6,
            'user_id' => $user->id
        ]);

        $advertisement->user()->associate($owner)->save();
        $advertisement->bids()->save($bid);

        $bid->user()->associate($user);
        $bid->advertisement()->associate($advertisement)->save();
        $advertisement->bids()->save($bid);

        $this->browse(function (Browser $browser) use ($advertisement, $user, $bid) {
            $browser->loginAs($user)
                ->visit("/advertisements/$advertisement->id")
                ->press("@delete_bid_{$bid->id}");
        });

        $this->assertDatabaseMissing('bids', [
            'id' => $bid->id
        ]);
    }
}
