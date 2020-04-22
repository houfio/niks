<?php

namespace Tests\Browser\Login;

use App\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class FormUnsuccessfulLoginTest extends DuskTestCase
{
    /**
     * @test
     * @throws Throwable
     */
    public function testUnsuccessfulLogin()
    {
        $user = factory(User::class)->create([
            'is_approved' => false
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->logout()
                ->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'test123')
                ->press('login')
                ->assertPathIs('/login');
        });
    }
}
