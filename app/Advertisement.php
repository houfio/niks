<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    public $timestamps = true;

    public function assets()
    {
        return $this->belongsToMany(Asset::class, 'advertisement_asset');
    }
}
