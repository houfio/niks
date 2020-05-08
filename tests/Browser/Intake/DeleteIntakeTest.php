<?php

namespace Tests\Browser\Intake;

use App\Intake;
use App\User;
use DateTime;
use Facebook\WebDriver\WebDriverBy;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class DeleteIntakeTest extends DuskTestCase
{
    /**
     * @test
     * @throws Throwable
     */
    public function testDeleteIntake()
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

        /** @var Intake $intake */
        $intake = factory(Intake::class)->make();

        $intake->invitee()->associate($newUser);
        $intake->inviter()->associate($user);
        $intake->date = $dueOn;
        $intake->accepted = false;

        $intake->save();

        $this->assertDatabaseHas('intakes', [
            'inviter_id' => $user->id,
            'invitee_id' => $newUser->id
        ]);

        $this->browse(function (Browser $browser) use ($user, $newUser, $dueOn, $intake) {
            $browser->loginAs($user)
                ->visit('/intakes')
                ->press("@delete_intake_{$intake->id}")
                ->assertPathIs('/intakes');
        });

        $this->assertDatabaseMissing('intakes', [
            'inviter_id' => $user->id,
            'invitee_id' => $newUser->id
        ]);
    }
}
