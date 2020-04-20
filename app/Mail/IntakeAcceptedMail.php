<?php

namespace App\Mail;

use App\Intake;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class IntakeAcceptedMail extends Mailable
{
    use Queueable, SerializesModels;

    public Intake $intake;

    public function __construct(Intake $intake)
    {
        $this->intake = $intake;
        $this->subject = __('mails/intake.title_accepted');
    }

    public function build()
    {
        return $this->view('mails.intake_accepted')
            ->from('no-reply@niksvoorniks.nl')
            ->replyTo('info@niksvoorniks.nl');
    }
}
