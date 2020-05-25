<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';
    public $timestamps = true;
    protected $fillable = [
        'first_name', 'last_name', 'email', 'subject', 'description'
    ];

    public function type()
    {
        return $this->belongsTo(TicketType::class, 'type_id');
    }

    public function responses()
    {
        return $this->hasMany(TicketResponse::class);
    }
}
