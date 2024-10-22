<?php

namespace Tests\Browser\Advertisement;

use App\Advertisement;
use App\User;
use Facebook\WebDriver\WebDriverBy;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class FilterAdvertisementTest extends DuskTestCase
{
    /**
     * @test
     * @throws Throwable
     */
    public function testFilterAdvertisement()
    {
        $user = factory(User::class)->create([
            'is_approved' => true
        ]);

        factory(Advertisement::class, 5)->make([
            'price' => 6
        ])->each(function (Advertisement $advertisement) use ($user) {
            $advertisement->user()->associate($user)->save();
        });

        /** @var Advertisement $searchAdvertisement */
        $searchAdvertisement = factory(Advertisement::class)->make([
            'price' => 5,
            'title' => 'This is a test ad'
        ]);

        $searchAdvertisement->user()->associate($user);
        $searchAdvertisement->save();

        $countedAdvertisements = Advertisement::where('title', '=', $searchAdvertisement->title)
            ->where('price', '<=', $searchAdvertisement->price)
            ->where('enable_bidding', '=', 0)
            ->count();

        $this->browse(function (Browser $browser) use ($user, $searchAdvertisement, $countedAdvertisements) {
            $browser->loginAs($user)
                ->visit('/advertisements')
                ->type('price', $searchAdvertisement->price)
                ->type('search', $searchAdvertisement->title)
                ->press('@search')
                ->assertQueryStringHas('price', $searchAdvertisement->price)
                ->assertQueryStringHas('search', $searchAdvertisement->title)
                ->assertPathIs('/advertisements');

            $advertisements = $browser->driver->findElements(WebDriverBy::className('advertisement'));
            $this->assertCount($countedAdvertisements, $advertisements);
        });
    }
}
