<?php

namespace Tests\Browser\User;

use App\User;
use Facebook\WebDriver\WebDriverBy;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class SortUsersByFirstNameDesc extends DuskTestCase
{
    /**
     * @test
     * @throws Throwable
     */
    public function testSortUserByFirstNameDesc()
    {
        $user = factory(User::class)->create([
            'is_approved' => true,
            'is_admin' => true
        ]);

        $foundUsers = [];
        factory(User::class, 5)->create();
        $sortedUsers = User::orderBy('first_name', 'desc')->limit(10)->get();

        $this->browse(function (Browser $browser) use ($user, &$foundUsers) {
            $browser->loginAs($user)
                ->visit('/users')
                ->select('sort', 'first_name')
                ->select('direction', 'desc')
                ->press('@search')
                ->assertPathIs('/users');

            $foundUsers = $browser->driver->findElements(WebDriverBy::id('user'));
        });

        foreach ($sortedUsers as $key => $sortedUser) {
            $this->assertEquals($foundUsers[$key]->getAttribute('innerHTML'), $sortedUser->getFullName());;
        }
    }
}
