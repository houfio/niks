<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class FormInvalidEmailTest extends DuskTestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @throws Throwable
     */
    public function testForgotPasswordFormInvalidEmail()
    {
        $user = factory(User::class)->create([
            'approved' => true
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/forgot')
                ->type('email', $user->first_name)
                ->press('forgot');
        });

        $this->assertDatabaseMissing('password_resets', [
            'email' => $user->email
        ]);
    }
}
