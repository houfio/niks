<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Intake extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'inviter_id', 'invitee_id', 'date', 'accepted'
    ];

    public function inviter() {
        return $this->belongsTo(User::class, 'inviter_id', 'id');
    }

    public function invitee() {
        return $this->belongsTo(User::class, 'invitee_id', 'id');
    }
}
