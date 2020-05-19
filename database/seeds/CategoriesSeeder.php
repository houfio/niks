<?php

use App\Advertisement;
use App\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        $cake = new Category();
        $cake->category = 'Taart';
        $cake->type = 'advertisement';
        $cake->save();

        $subCategory = new Category();
        $subCategory->category = 'Appeltaart';
        $subCategory->parent()->associate($cake);
        $subCategory->save();

        $subCategory = new Category();
        $subCategory->category = 'Kersentaart';
        $subCategory->parent()->associate($cake);
        $subCategory->save();

        $subCategory = new Category();
        $subCategory->category = 'Zonder suiker';
        $subCategory->parent()->associate($subCategory);
        $subCategory->save();

        $labor = new Category();
        $labor->category = 'Handwerk';
        $labor->type = 'advertisement';
        $labor->save();

        $subCategory = new Category();
        $subCategory->category = 'Tuin';
        $subCategory->parent()->associate($labor);
        $subCategory->save();

        $subCategory = new Category();
        $subCategory->category = 'Grasmaaien';
        $subCategory->parent()->associate($labor);
        $subCategory->save();

        $categories = Category::all();
        $advertisements = Advertisement::all();

        foreach ($advertisements as $advertisement) {
            $advertisement->categories()->saveMany($categories->random(rand(1, 3)));
        }
    }
}
