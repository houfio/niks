<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
        $this->subject = __('mail.resetPassword.title');
    }

    public function build()
    {
        return $this->view('mails.reset_password')
            ->from('no-reply@niksvoorniks.nl')
            ->replyTo('info@niksvoorniks.nl');
    }
}
