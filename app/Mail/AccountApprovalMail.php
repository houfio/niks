<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountApprovalMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;

    public string $token;

    public function __construct(string $token, User $user)
    {
        $this->user = $user;
        $this->token = $token;
        $this->subject = __('mails/approved.title');
    }

    public function build()
    {
        return $this->view('mails.approved')
            ->from('no-reply@niksvoorniks.nl')
            ->replyTo('info@niksvoorniks.nl');
    }
}
