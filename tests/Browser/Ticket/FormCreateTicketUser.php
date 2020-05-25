<?php

namespace Tests\Browser\Ticket;

use App\TicketType;
use App\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class FormCreateTicketUser extends DuskTestCase
{
    /**
     * @test
     * @throws Throwable
     */
    public function testCreateTicketUser()
    {
        $user = factory(User::class)->create();
        $type = TicketType::all()->random();

        $this->browse(function (Browser $browser) use ($user, $type) {
            $browser->loginAs($user)
                ->visit('/tickets/create')
                ->select('type', $type->type)
                ->type('subject', 'Test subject')
                ->type('description', 'Test description for this ticket')
                ->press('create_ticket')
                ->assertPathIs('/');
        });

        $this->assertDatabaseHas('tickets', [
            'email' => $user->email,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'type_id' => $type->id
        ]);
    }
}
