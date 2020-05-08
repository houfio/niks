<?php

namespace Tests\Browser\Intake;

use App\User;
use DateTime;
use Facebook\WebDriver\WebDriverBy;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class CreateIntakeTest extends DuskTestCase
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

        $dueOn = new DateTime();
        $dueOn->modify('+8 days');

        /** @var User $newUser */
        $newUser = factory(User::class)->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'is_approved' => false,
            'is_admin' => false
        ]);

        $this->browse(function (Browser $browser) use ($user, $newUser, $dueOn) {
            $browser->loginAs($user)
                ->visit('/intakes')
                ->press('@create_intake')
                ->select('invitee', $newUser->id)
                ->script([
                    'document.getElementById("date").value = "' . str_replace('UTC', 'T', $dueOn->format('Y-m-dTH:i')) . '"',
                ]);

            $browser->press('create')
                ->assertPathIs('/intakes');
        });

        $this->assertDatabaseHas('intakes', [
            'inviter_id' => $user->id,
            'invitee_id' => $newUser->id
        ]);
    }
}
