<?php

namespace Tests\Browser;

use App\Advertisement;
use App\Asset;
use App\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class GoToAdvertisementView extends DuskTestCase
{
    /**
     * @test
     * @throws Throwable
     */
    public function testGoToAdvertisementView()
    {
        /** @var Advertisement $advertisement */
        $advertisement = factory(Advertisement::class)->make();
        $user = factory(User::class)->create(['is_approved' => true]);
        $assets = factory(Asset::class, 3)->create();

        $advertisement->user()->associate($user)->save();
        $advertisement->assets()->saveMany($assets);

        $this->browse(function (Browser $browser) use ($advertisement, $user) {
            $currentBrowser = $browser->loginAs($user)
                ->visit("/advertisements/$advertisement->id")
                ->assertPathIs("/advertisements/$advertisement->id");

            $this->assertEquals($currentBrowser->text('@title'), $advertisement->title);
            $this->assertEquals($currentBrowser->text('@description'), $advertisement->long_description);
        });
    }
}
