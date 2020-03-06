<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class FormLogoutTest extends DuskTestCase
{
    use RefreshDatabase;

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
                ->loginAs($user)
                ->assertAuthenticatedAs($user)
                ->visit('/logout')
                ->assertPathIs('/login');
        });
    }
}
