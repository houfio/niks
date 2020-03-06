<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class FormTest extends DuskTestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @throws Throwable
     */
    public function testForgotPasswordForm()
    {
        $user = factory(User::class)->create([
            'approved' => true
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/forgot')
                ->type('email', $user->email)
                ->press('forgot');
        });

        $this->assertDatabaseHas('password_resets', [
            'email' => $user->email
        ]);
    }
}
