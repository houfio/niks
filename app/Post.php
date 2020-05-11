<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    public $timestamps = true;

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
}
