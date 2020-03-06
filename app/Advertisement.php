<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $table = 'advertisements';
    public $timestamps = true;

    public function assets()
    {
        return $this->belongsToMany(Asset::class, 'advertisement_asset');
    }
}
