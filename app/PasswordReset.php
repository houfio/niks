<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';
    protected $primaryKey = 'email';
    protected $table = 'password_resets';

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function (PasswordReset $model) {
            $model->created_at = $model->freshTimestamp();
        });
    }
}
