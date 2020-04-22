<?php

namespace App\Mail;

use App\Intake;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class IntakeAcceptedMail extends Mailable
{
    use Queueable, SerializesModels;

    public Intake $intake;
    public User $receiver;

    public function __construct(Intake $intake, User $receiver)
    {
        $this->intake = $intake;
        $this->receiver = $receiver;
        $this->subject = __('mails/intake.title_accepted');
    }

    public function build()
    {
        return $this->view('mails.intake_accepted')
            ->from('no-reply@niksvoorniks.nl')
            ->replyTo('info@niksvoorniks.nl');
    }
}
