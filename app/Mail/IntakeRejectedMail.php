<?php

namespace App\Mail;

use App\Intake;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class IntakeRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public Intake $intake;
    public User $receiver;

    public function __construct(Intake $intake, User $receiver)
    {
        $this->intake = $intake;
        $this->receiver = $receiver;
        $this->subject = __('mails/intake.title_rejected');
    }

    public function build()
    {
        return $this->view('mails.intake_rejected')
            ->from('no-reply@niksvoorniks.nl')
            ->replyTo('info@niksvoorniks.nl');
    }
}
