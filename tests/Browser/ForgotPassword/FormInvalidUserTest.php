<?php

namespace Tests\Browser;

use App\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class FormInvalidUserTest extends DuskTestCase
{
    /**
     * @test
     * @throws Throwable
     */
    public function testForgotPasswordFormInvalidUser()
    {
        $user = factory(User::class)->make([
            'approved' => true
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/forgot')
                ->type('email', $user->email)
                ->press('forgot');
        });

        $this->assertDatabaseMissing('password_resets', [
            'email' => $user->email
        ]);
    }
}
