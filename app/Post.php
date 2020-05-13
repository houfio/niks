<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    public $timestamps = true;

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function header()
    {
        return $this->belongsTo(Asset::class, 'header_id');
    }
}
