<?php

use App\Advertisement;
use App\Asset;
use Illuminate\Database\Seeder;

class AssetSeeder extends Seeder
{
    public function run()
    {
        $advertisements = Advertisement::all()->pluck('id')->toArray();

        factory(Asset::class, 100)->create()->each(function (Asset $asset) use ($advertisements) {
            $asset->advertisements()->attach(array_rand($advertisements, mt_rand(1, 3)));
        });
    }
}
