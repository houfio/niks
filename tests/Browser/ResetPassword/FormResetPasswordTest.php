<?php

namespace Tests\Browser;

use App\PasswordReset;
use App\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class FormResetPasswordTest extends DuskTestCase
{
    /**
     * @test
     * @throws Throwable
     */
    public function testResetPasswordForm()
    {
        $user = factory(User::class)->create([
            'approved' => true
        ]);

        $passwordResetData = factory(PasswordReset::class)->make();

        factory(PasswordReset::class)->create([
            'email' => $user->email,
            'token' => Hash::make($passwordResetData->token)
        ]);

        $this->browse(function (Browser $browser) use ($user, $passwordResetData) {
            $user->password = 'newPassword123';

            $browser->visit("/reset/$passwordResetData->token")
                ->type('email', $user->email)
                ->type('password', $user->password)
                ->type('password_confirmation', $user->password)
                ->press('reset')
                ->assertAuthenticatedAs($user);
        });
    }
}
