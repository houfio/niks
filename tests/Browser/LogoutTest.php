<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class LogoutTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     * @throws Throwable
     */
    public function testLogout()
    {
        $user = factory(User::class)->create([
            'approved' => true
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->logout()
                ->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'test123')
                ->press('login')
                ->visit('/logout')
                ->assertPathIs('/login');
        });
    }
}
