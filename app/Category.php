<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Category extends Model
{
    protected $table = 'categories';
    public $timestamps = true;

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('children');
    }

    public function getChildren()
    {
        $children = $this->children()->get();
        $collection = new Collection();

        foreach ($this->attributes as $key => $attribute) {
            $collection->put($key, $attribute);
        }

        $collection->put('children', $children);
        return $collection;
    }

    public function advertisements()
    {
        return $this->belongsToMany(Advertisement::class, 'advertisement_categories');
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_categories');
    }

    public function getPostCategories()
    {
        return $this->getCategories('post');
    }


    public function getAdvertisementCategories()
    {
        return $this->getCategories('advertisement');
    }

    public function getAllCategories()
    {
        return $this->getCategories();
    }

    private function getCategories(string $type = '')
    {
        $parents = $type !== '' ? self::where('type', '=', $type) : self::where('parent_id', '=', null);
        $parents = $parents->get();

        $categories = [];

        foreach ($parents as $category) {
            $categories[] = $category->getChildren();
        }

        return $categories;
    }
}
