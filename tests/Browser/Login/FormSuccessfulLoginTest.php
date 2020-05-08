<?php

namespace Tests\Browser\Login;

use App\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class FormSuccessfulLoginTest extends DuskTestCase
{
    /**
     * @test
     * @throws Throwable
     */
    public function testSuccessfulLogin()
    {
        $user = factory(User::class)->create([
            'is_approved' => true
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->logout()
                ->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'test123')
                ->press('login')
                ->assertPathIs('/')
                ->assertAuthenticatedAs($user);
        });
    }
}
