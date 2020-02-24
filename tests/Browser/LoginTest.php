<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     * @throws Throwable
     */
    public function testSuccessfulLogin()
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
                ->assertPathIs('/')
                ->assertAuthenticated();
        });
    }

    /**
     * @test
     * @throws Throwable
     */
    public function testUnsuccessfulLogin()
    {
        $user = factory(User::class)->create();

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
