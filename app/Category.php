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
        return self::where('type', '=', 'post')->get();
    }


    public function getAdvertisementCategories()
    {
        return self::where('type', '=', 'advertisement')->get();
    }
}
