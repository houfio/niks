<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketResponse extends Model
{
    protected $table = 'ticket_responses';
    public $timestamps = true;

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
