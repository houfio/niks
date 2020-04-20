<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class IntakeAcceptedMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $invitee;

    public function __construct(User $invitee)
    {
        $this->invitee = $invitee;
        $this->subject = __('mails/intake.title_accepted');
    }

    public function build()
    {
        return $this->view('mails.intake_accepted')
            ->from('no-reply@niksvoorniks.nl')
            ->replyTo('info@niksvoorniks.nl');
    }
}
