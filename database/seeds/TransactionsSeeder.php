<?php

use App\Transaction;
use Illuminate\Database\Seeder;

class TransactionsSeeder extends Seeder
{
    public function run()
    {
        factory(Transaction::class, 20)->create();
    }
}
