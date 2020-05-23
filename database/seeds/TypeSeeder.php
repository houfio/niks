<?php

use App\TicketType;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    public function run()
    {
        $types = [
            'Suggestie',
            'Probleem melden',
            'Vraag',
            'Overig'
        ];

        foreach ($types as $current_type)
        {
            $type = new TicketType();
            $type->type = $current_type;
            $type->save();
        }
    }
}
