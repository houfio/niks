<?php

namespace Tests\Browser\Ticket;

use App\Ticket;
use App\TicketType;
use App\User;
use Facebook\WebDriver\WebDriverBy;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class FormAdminReplyToTicketTest extends DuskTestCase
{
    /**
     * @test
     * @throws Throwable
     */
    public function testAdminReplyToTicket()
    {
        $admin = factory(User::class)->create([
            'is_admin' => true,
            'is_approved' => true
        ]);

        $user = factory(User::class)->make();

        /** @var Ticket $ticket */
        $ticket = factory(Ticket::class)->make([
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email
        ]);

        $type = new TicketType();
        $type->type = 'Test type';
        $type->save();

        $ticket->type()->associate($type)->save();

        $this->browse(function (Browser $browser) use ($admin, $ticket) {
            $browser->loginAs($admin)
                ->visit("/tickets/$ticket->id/edit")
                ->type('response', 'Test reply for this ticket')
                ->press('reply')
                ->assertPathIs("/tickets/$ticket->id/edit");

            $responses = $browser->driver->findElements(WebDriverBy::id('response_item'));
            $this->assertCount($ticket->responses()->count(), $responses);
        });

        $this->assertDatabaseHas('ticket_responses', [
            'ticket_id' => $ticket->id,
            'response' => 'Test reply for this ticket'
        ]);
    }
}
