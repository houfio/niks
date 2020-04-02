<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $token;
    public User $user;

    public function __construct(string $token, User $user)
    {
        $this->token = $token;
        $this->user = $user;
        $this->subject = __('mail.resetPassword.title');
    }

    public function build()
    {
        return $this->view('mails.reset_password')
            ->from('no-reply@niksvoorniks.nl')
            ->replyTo('info@niksvoorniks.nl');
    }
}
