<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'types';
    public $timestamps = false;


    protected $fillable = [
        'type'
    ];

    public function ticket()
    {
        return $this->belongsToMany(Ticket::class);
    }
}
