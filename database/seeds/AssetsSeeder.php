<?php

use App\Advertisement;
use App\Asset;
use Illuminate\Database\Seeder;

class AssetsSeeder extends Seeder
{
    public function run()
    {
        $advertisements = Advertisement::all();

        factory(Asset::class, 100)->create()->each(function (Asset $asset) use ($advertisements) {
            $asset->advertisements()->saveMany($advertisements->random(rand(1, 3)));
        });
    }
}
