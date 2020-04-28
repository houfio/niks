<?php

namespace Tests\Browser\CreateAdvertisement;

use App\Advertisement;
use App\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateUnsuccessfulAdvertisementTest extends DuskTestCase
{
    public function testCreateUnsuccessfulAdvertisement()
    {
        $user = factory(User::class)->create([
            'is_approved' => true
        ]);
        $advertisement = factory(Advertisement::class)->make();
        $image = public_path('imgs/logo.png');

        $this->browse(function (Browser $browser) use ($user, $advertisement, $image) {
            $browser->loginAs($user)
                ->visit('/advertisements/create')
                ->type('title', $advertisement->title)
                ->type('price', $advertisement->price)
                ->type('short_description', 'minder dan 30 characters')
                ->type('long_description', $advertisement->long_description)
                ->attach('images[]', $image)
                ->press('create')
                ->assertPathIs('/advertisements/create');
        });
    }
}
