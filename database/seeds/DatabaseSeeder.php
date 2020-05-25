<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Artisan::call('migrate:fresh');

        $this->call([
            UsersSeeder::class,
            CategoriesSeeder::class,
            AssetsSeeder::class,
            BidsSeeder::class,
            InterviewsSeeder::class,
            TransactionsSeeder::class,
            PostsSeeder::class,
            TicketTypesSeeder::class,
            TicketsSeeder::class
        ]);
    }
}
