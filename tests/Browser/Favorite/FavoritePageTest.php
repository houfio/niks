<?php

namespace Tests\Browser\Favorite;

use App\Advertisement;
use App\Bid;
use App\User;
use Facebook\WebDriver\WebDriverBy;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class FavoritePageTest extends DuskTestCase
{
    /**
     * @test
     * @throws Throwable
     */
    public function testGoToFavoritePage()
    {
        $owner = factory(User::class)->create([
            'is_approved' => true
        ]);

        /** @var User $user */
        $user = factory(User::class)->create([
            'is_approved' => true
        ]);

        $advertisements = factory(Advertisement::class, 4)->make()->each(function (Advertisement $advertisement) use ($owner, $user) {
            $advertisement->user()->associate($owner)->save();
        });

        $user->favorites()->saveMany($advertisements);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/')
                ->click('@favorites');

            $favorites = $browser->driver->findElements(WebDriverBy::className('advertisement'));
            $this->assertCount(4, $favorites);
        });
    }
}
