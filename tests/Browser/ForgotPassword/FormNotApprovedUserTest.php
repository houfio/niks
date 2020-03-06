<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class FormNotApprovedUserTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     * @throws Throwable
     */
    public function testForgotPasswordFormNotApprovedUser()
    {
        $user = factory(User::class)->create();

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
