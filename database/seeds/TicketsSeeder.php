<?php

use App\Ticket;
use Illuminate\Database\Seeder;

class TicketsSeeder extends Seeder
{
    public function run()
    {
        factory(Ticket::class, 10)->create();
    }
}
