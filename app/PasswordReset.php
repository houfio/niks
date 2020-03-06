<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'password_resets';

    protected $casts = [
        'created_at' => 'datetime',
    ];
}
