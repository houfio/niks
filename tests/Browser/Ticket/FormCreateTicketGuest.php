<?php

namespace Tests\Browser\Ticket;

use App\TicketType;
use App\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class FormCreateTicketGuest extends DuskTestCase
{
    /**
     * @test
     * @throws Throwable
     */
    public function testCreateTicketGuest()
    {
        $user = factory(User::class)->make();
        $type = TicketType::all()->random();

        $this->browse(function (Browser $browser) use ($user, $type) {
            $browser->visit('/tickets/create')
                ->type('first_name', $user->first_name)
                ->type('last_name', $user->last_name)
                ->type('email', $user->email)
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
