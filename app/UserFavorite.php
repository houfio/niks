<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserFavorite extends Pivot
{
    public $timestamps = true;
    protected $table = 'user_favorites';
}
