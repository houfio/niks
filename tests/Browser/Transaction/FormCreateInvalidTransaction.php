<?php

namespace Tests\Browser\Transaction;

use App\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class FormCreateInvalidTransaction extends DuskTestCase
{
    /**
     * @test
     * @throws Throwable
     */
    public function testCreateInvalidTransaction()
    {
        /** @var User $sender */
        $sender = factory(User::class)->create([
            'is_approved' => true
        ]);

        $receiver = factory(User::class)->create();

        $this->browse(function (Browser $browser) use ($sender, $receiver) {
            $browser->loginAs($sender)
                ->visit("/users/$receiver->id")
                ->click('@transfer')
                ->type('amount', 160)
                ->click('@create_transaction')
                ->assertPathIs("/users/$receiver->id");
        });

        $this->assertDatabaseMissing('transactions', [
            'amount' => 160,
            'receiver_id' => $receiver->id,
            'sender_id' => $sender->id
        ]);
    }
}
