<?php

namespace App;

use App\Mail\AccountApprovalMail;
use App\Mail\PasswordResetMail;
use App\Traits\UpdateCoordinates;
use Carbon\Carbon;
use DateTime;
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

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function intakes()
    {
        return $this->hasMany(Intake::class, 'invitee_id');
    }

    public function sentIntakes()
    {
        return $this->hasMany(Intake::class, 'inviter_id');
    }

    public function avatar()
    {
        return $this->belongsTo(Asset::class, 'avatar_id');
    }

    public function header()
    {
        return $this->belongsTo(Asset::class, 'header_id');
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Advertisement::class, 'user_favorites')
            ->using(UserFavorite::class)
            ->withPivot([
                'created_at',
                'updated_at',
            ]);
    }

    public function sentTransactions()
    {
        return $this->hasMany(Transaction::class, 'avatar_id');
    }

    public function receivedTransactions()
    {
        return $this->hasMany(Transaction::class, 'header_id');
    }

    public function sendPasswordResetNotification($token)
    {
        if ($this->is_approved) {
            Mail::to($this->email)->send(new PasswordResetMail($token, $this));
        } else {
            Mail::to($this->email)->send(new AccountApprovalMail($token, $this));
        }
    }

    public function getFullName(): string
    {
        return "$this->first_name $this->last_name";
    }

    public function getAmount(DateTime $date = null): int
    {
        if (!$date) {
            $date = Carbon::today();
        }

        $date = $date->toDateString();
        $sent = Transaction::where('sender_id', '=', $this->id)->whereDate('created_at', '<=', $date)->sum('amount');

        return Transaction::where('receiver_id', '=', $this->id)->whereDate('created_at', '<=', $date)->sum('amount') - $sent;
    }
}
