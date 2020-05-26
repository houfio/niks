<?php

use App\Advertisement;
use App\Category;
use App\Post;
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

        $holiday = new Category();
        $holiday->category = 'Feestdag';
        $holiday->type = 'post';
        $holiday->save();

        $important = new Category();
        $important->category = 'Belangrijk';
        $important->type = 'post';
        $important->save();

        $technical = new Category();
        $technical->category = 'Technisch';
        $technical->type = 'post';
        $technical->save();

        $regional = new Category();
        $regional->category = 'Regionaal';
        $regional->type = 'post';
        $regional->save();

        $categories = Category::all();
        $advertisements = Advertisement::all();
        $posts = Post::all();

        foreach ($advertisements as $advertisement) {
            $advertisement->categories()->saveMany($categories->where('type', 'advertisement')->random(rand(1, 2)));
        }

        foreach ($posts as $post) {
            $post->categories()->saveMany($categories->where('type', 'post')->random(rand(1, 2)));
        }
    }
}
