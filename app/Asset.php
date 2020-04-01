<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $table = 'assets';
    public $timestamps = true;

    public function advertisements()
    {
        return $this->belongsToMany(Advertisement::class, 'advertisement_assets');
    }
}
