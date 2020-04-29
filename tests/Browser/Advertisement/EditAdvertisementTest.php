<?php

namespace Tests\Browser;

use App\Advertisement;
use App\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EditAdvertisementTest extends DuskTestCase
{
    public function testEditAdvertisement()
    {
        $user = factory(User::class)->create([
            'is_approved' => true,
            'is_admin' => true
        ]);

        $image = public_path('imgs/logo.png');

        /** @var Advertisement $advertisement */
        $advertisement = factory(Advertisement::class)->make();
        $advertisement->user()->associate($user);
        $advertisement->save();

        $this->browse(function (Browser $browser) use ($user, $advertisement, $image) {
            $browser->loginAs($user)
                ->visit("/advertisements/{$advertisement->id}")
                ->press("@edit_advertisement")
                ->type('title', 'Nieuwe bosbessentaart!')
                ->select('is_service', '0')
                ->press('@clear_images')
                ->attach('images[]', $image)
                ->press('@update');
        });

        $this->assertDatabaseHas('advertisements', [
            'title' => 'Nieuwe bosbessentaart!'
        ]);
    }
}
