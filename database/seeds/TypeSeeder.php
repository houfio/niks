<?php

use App\Type;
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
        foreach ($types as $type) {
            factory(Type::class)->create([
                'type' => $type
            ]);
        }
    }
}
