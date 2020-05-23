<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    protected $table = 'ticket_types';
    public $timestamps = false;


    protected $fillable = [
        'type'
    ];

    public function ticket()
    {
        return $this->belongsToMany(Ticket::class);
    }
}
