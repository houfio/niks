<?php

namespace Tests\Browser\Interview;

use App\User;
use DateTime;
use Facebook\WebDriver\WebDriverBy;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class CreateInterviewTest extends DuskTestCase
{
    /**
     * @test
     * @throws Throwable
     */
    public function testCreateInterview()
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
                ->visit('/interviews')
                ->press('@create_interview')
                ->select('invitee', $newUser->id)
                ->script([
                    'document.getElementById("date").value = "' . str_replace('UTC', 'T', $dueOn->format('Y-m-dTH:i')) . '"',
                ]);

            $browser->press('create')
                ->assertPathIs('/interviews');
        });

        $this->assertDatabaseHas('interviews', [
            'inviter_id' => $user->id,
            'invitee_id' => $newUser->id
        ]);
    }
}
