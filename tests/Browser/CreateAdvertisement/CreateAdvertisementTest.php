<?php

namespace Tests\Browser;

use App\Advertisement;
use App\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateAdvertisementTest extends DuskTestCase
{
    public function testCreateAdvertisement()
    {
        $user = factory(User::class)->create([
            'is_approved' => true
        ]);
        $advertisement = factory(Advertisement::class)->make();

        $this->browse(function (Browser $browser) use ($user, $advertisement) {
            $browser->loginAs($user)
                ->visit('/advertisements/create')
                ->type('title', $advertisement->title)
                ->type('price', $advertisement->price)
                ->type('short_description', $advertisement->short_description)
                ->type('long_description', $advertisement->long_description)
                ->attach('images[]', 'https://placeimg.com/640/360/any')
                ->press('create')
                ->assertPathIs('/');
        });
    }
}
