<?php

namespace Tests\Browser\User;

use App\Advertisement;
use App\Asset;
use App\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class GoToProfilePage extends DuskTestCase
{
    /**
     * @test
     * @throws Throwable
     */
    public function testGoToProfileView()
    {
        /** @var User $user */
        $user = factory(User::class)->create(['is_approved' => true]);

        $this->browse(function (Browser $browser) use ($user) {
            $currentBrowser = $browser->loginAs($user)
                ->visit('/')
                ->click('@profile')
                ->assertPathIs("/users/$user->id");

            $this->assertEquals($currentBrowser->text('@user_name'), $user->getFullName());
        });
    }
}
