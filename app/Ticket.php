<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';
    public $timestamps = true;

    protected $fillable = [
        'fist_name', 'last_name', 'email', 'subject', 'description'
    ];
}