<?php

use App\Ticket;
use App\Type;
use Illuminate\Database\Seeder;

class TicketsSeeder extends Seeder
{
    public function run()
    {
        $types = Type::all();

        factory(Ticket::class, 10)->make()->each(function (Ticket $ticket) use ($types) {
            $ticket->type()->associate($types->random())->save();
        });
    }
}
