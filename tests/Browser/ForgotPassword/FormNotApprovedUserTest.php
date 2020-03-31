<?php

namespace Tests\Browser;

use App\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class FormNotApprovedUserTest extends DuskTestCase
{
    /**
     * @test
     * @throws Throwable
     */
    public function testForgotPasswordFormNotApprovedUser()
    {
        $user = factory(User::class)->create([
            'is_approved' => false
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/reset')
                ->type('email', $user->email)
                ->press('forgot');
        });

        $this->assertDatabaseMissing('password_resets', [
            'email' => $user->email
        ]);
    }
}
