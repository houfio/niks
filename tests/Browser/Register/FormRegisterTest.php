<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class FormRegisterTest extends DuskTestCase
{
    /**
     * @test
     * @throws Throwable
     */
    public function testRequestAccount()
    {
        $user = factory(User::class)->make();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/register')
                ->type('first_name', $user->first_name)
                ->type('last_name', $user->last_name)
                ->type('email', $user->email)
                ->type('phone_number', $user->phone_number)
                ->type('zip_code', $user->zip_code)
                ->type('house_number', $user->house_number)
                ->type('description', 'test')
                ->press('register')
                ->assertPathIs('/');
        });

        $this->assertDatabaseHas('users', [
           'email' => $user->email
        ]);
    }
}
