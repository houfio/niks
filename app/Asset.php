<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Asset extends Model
{
    protected $table = 'assets';
    public $timestamps = true;

    public function advertisements()
    {
        return $this->belongsToMany(Advertisement::class, 'advertisement_assets');
    }

    public function url(): string
    {
        return Storage::url($this->path);
    }
}
