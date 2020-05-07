<?php

namespace Tests\Browser\User;

use App\User;
use Facebook\WebDriver\WebDriverBy;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class SearchUserTest extends DuskTestCase
{
    /**
     * @test
     * @throws Throwable
     */
    public function testSearchUser()
    {
        $user = factory(User::class)->create([
            'is_approved' => true,
            'is_admin' => true
        ]);

        /** @var User $foundUser */
        $foundUser = factory(User::class)->create([
            'first_name' => 'Test',
            'last_name' => 'User'
        ]);

        factory(User::class, 5)->create();

        $this->browse(function (Browser $browser) use ($user, $foundUser) {
            $browser->loginAs($user)
                ->visit('/users')
                ->type('search', $foundUser->getFullName())
                ->press('@search')
                ->assertPathIs('/users');

            $users = $browser->driver->findElements(WebDriverBy::id('user'));
            $this->assertCount(1, $users);
        });
    }
}
