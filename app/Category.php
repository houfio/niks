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

    public static function getPostCategories()
    {
        return static::getCategories('post');
    }

    public static function getAdvertisementCategories()
    {
        return static::getCategories('advertisement');
    }

    public static function getAllCategories()
    {
        return static::getCategories();
    }

    private static function getCategories(string $type = ''): array
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
