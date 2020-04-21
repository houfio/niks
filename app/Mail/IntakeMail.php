<?php

namespace App\Mail;

use App\Intake;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class IntakeMail extends Mailable
{
    use Queueable, SerializesModels;

    public Intake $intake;
    public string $token;

    public function __construct(Intake $intake, string $token)
    {
        $this->intake = $intake;
        $this->token = $token;
        $this->subject = __('mails/intake.title_requested');
    }

    public function build()
    {
        return $this->view('mails.intake_requested')
            ->from('no-reply@niksvoorniks.nl')
            ->replyTo('info@niksvoorniks.nl');
    }
}
