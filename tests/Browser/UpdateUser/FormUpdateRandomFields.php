<?php

namespace Tests\Browser;

use App\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class FormUpdateRandomFields extends DuskTestCase
{
    /**
     * @test
     * @throws Throwable
     */
    public function testRandomUpdateUser()
    {
        $admin = factory(User::class)->create([
            'is_approved' => true,
            'is_admin' => true
        ]);

        $user = factory(User::class)->create();
        $newUser = factory(User::class)->make();

        $this->browse(function (Browser $browser) use ($admin, $user, $newUser) {
            $browser->loginAs($admin)
                ->visit("/users/$user->id/edit")
                ->type('email', $newUser->email)
                ->type('first_name', $newUser->first_name)
                ->type('last_name', $newUser->last_name)
                ->type('phone_number', $newUser->phone_number)
                ->type('zip_code', $newUser->zip_code)
                ->type('house_number', $newUser->house_number)
                ->type('neighbourhood', $newUser->neighbourhood)
                ->uncheck('is_admin')
                ->check('is_approved')
                ->press('edit')
                ->assertPathIs("/users/$user->id/edit");
        });

        $this->assertDatabaseHas('users', [
            'email' => $newUser->email,
            'first_name' => $newUser->first_name,
            'last_name' => $newUser->last_name,
            'phone_number' => $newUser->phone_number,
            'zip_code' => $newUser->zip_code,
            'house_number' => $newUser->house_number,
            'neighbourhood' => $newUser->neighbourhood
        ]);
    }
}
