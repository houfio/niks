<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    public $timestamps = false;

    public function advertisements()
    {
        return $this->belongsToMany(Advertisement::class, 'advertisement_asset');
    }
}
