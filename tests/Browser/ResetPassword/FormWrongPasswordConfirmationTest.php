<?php

namespace Tests\Browser;

use App\PasswordReset;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class FormWrongPasswordConfirmationTest extends DuskTestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @throws Throwable
     */
    public function testWrongPasswordConfirmation()
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
            $browser->visit("/reset/$passwordResetData->token")
                ->type('email', $user->email)
                ->type('password', 'newPassword123')
                ->type('password_confirmation', 'wrongPassword123')
                ->press('reset')
                ->assertGuest();
        });
    }
}
