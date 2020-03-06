<?php

namespace Tests\Browser;

use App\PasswordReset;
use App\User;
use DateTime;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class FormExpiredTokenTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     * @throws Throwable
     */
    public function testResetPasswordFormExpiredToken()
    {
        $user = factory(User::class)->create([
            'approved' => true
        ]);

        $customDate = new DateTime();
        $passwordResetData = factory(PasswordReset::class)->make();

        factory(PasswordReset::class)->create([
            'email' => $user->email,
            'token' => $passwordResetData->token,
            'created_at' => $customDate->modify("+2 days")
        ]);

        $this->browse(function (Browser $browser) use ($user, $passwordResetData) {
            $user->password = 'newPassword123';

            $browser->visit("/reset/$passwordResetData->token")
                ->type('email', $user->email)
                ->type('password', $user->password)
                ->type('password_confirmation', $user->password)
                ->press('reset')
                ->assertGuest();
        });
    }
}
