<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class RequestAccountTest extends DuskTestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @throws Throwable
     */
    public function requestAccountFormTest()
    {
        $user = factory(User::class)->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/account/request')
                ->type('firstName', $user->first_name)
                ->type('lastName', $user->last_name)
                ->type('email', $user->email)
                ->type('phoneNumber', $user->phone_number)
                ->type('zipCode', $user->zip_code)
                ->type('houseNumber', $user->house_number)
                ->type('neighbourhood', $user->neighbourhood)
                ->press('requestAccount')
                ->assertPathIs('/');
        });

        $this->assertDatabaseHas('users', [
           'email' => $user->email
        ]);
    }
}
