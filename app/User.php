<?php

namespace App;

use App\Mail\PasswordResetMail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use Notifiable;
    use CanResetPassword;

    public $timestamps = true;

    protected $fillable = [
        'first_name', 'email', 'password', 'last_name'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
        'is_approved' => 'boolean'
    ];

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }

    public function sendPasswordResetNotification($token)
    {
        Mail::to($this->email)->send(new PasswordResetMail($token, $this));
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function getFullName(): string
    {
        return "$this->first_name $this->last_name";
    }
}
