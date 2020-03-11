<?php

namespace Tests\Browser;

use App\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class FormTest extends DuskTestCase
{
    /**
     * @test
     * @throws Throwable
     */
    public function testForgotPasswordForm()
    {
        $user = factory(User::class)->create([
            'is_approved' => true
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/reset')
                ->type('email', $user->email)
                ->press('forgot');
        });

        $this->assertDatabaseHas('password_resets', [
            'email' => $user->email
        ]);
    }
}
