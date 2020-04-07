<?php

namespace Tests\Browser;

use App\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class DisapproveUserTest extends DuskTestCase
{
    /**
     * @test
     * @throws Throwable
     */
    public function testDisapproveUser()
    {
        $admin = factory(User::class)->create([
            'is_admin' => true,
            'is_approved' => true
        ]);

        $user = factory(User::class)->create([
            'password' => '',
            'is_admin' => false,
            'is_approved' => false
        ]);

        $this->browse(function (Browser $browser) use ($admin, $user) {
            $browser->loginAs($admin)
                ->visit('/users')
                ->click("@disapprove_$user->id")
                ->assertPathIs('/users');
        });

        $this->assertDatabaseMissing('users', [
            'id' => $user->id
        ]);
    }
}
