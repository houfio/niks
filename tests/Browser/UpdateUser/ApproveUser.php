<?php

namespace Tests\Browser\UpdateUser;

use App\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class ApproveUser extends DuskTestCase
{
    /**
     * @test
     * @throws Throwable
     */
    public function testApproveUser()
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
                ->click("@approve_$user->id")
                ->assertPathIs('/users');
        });

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'is_approved' => true
        ]);
    }
}
