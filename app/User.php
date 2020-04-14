<?php

namespace App;

use App\Mail\AccountApprovalMail;
use App\Mail\PasswordResetMail;
use App\Traits\UpdateCoordinates;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use Notifiable, CanResetPassword, UpdateCoordinates;

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

    protected array $updateCoordinates = [
        'houseNumber' => 'house_number',
        'zipCode' => 'zip_code'
    ];

    public function setAttributes(array $attributes): void
    {
        $this->attributes = $attributes;
    }

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }

    public function intakes()
    {
        return $this->hasMany(Intake::class, 'invitee_id');
    }

    public function sentIntakes()
    {
        return $this->hasMany(Intake::class, 'inviter_id');
    }

    public function sendPasswordResetNotification($token)
    {
        if ($this->is_approved) {
            Mail::to($this->email)->send(new PasswordResetMail($token, $this));
        } else {
            Mail::to($this->email)->send(new AccountApprovalMail($token, $this));
        }
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
