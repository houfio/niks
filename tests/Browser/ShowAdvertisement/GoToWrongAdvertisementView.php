<?php

namespace Tests\Browser\ShowAdvertisement;

use App\Advertisement;
use App\Asset;
use App\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class GoToWrongAdvertisementView extends DuskTestCase
{
    /**
     * @test
     * @throws Throwable
     */
    public function testGoToAdvertisementView()
    {
        $user = factory(User::class)->create(['is_approved' => true]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/advertisements/9999')
                ->assertPathIs('/advertisements/9999')
                ->assertTitle('Not Found');
        });
    }
}
