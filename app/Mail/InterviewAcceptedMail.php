<?php

namespace App\Mail;

use App\Interview;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InterviewAcceptedMail extends Mailable
{
    use Queueable, SerializesModels;

    public Interview $interview;
    public User $receiver;

    public function __construct(Interview $interview, User $receiver)
    {
        $this->interview = $interview;
        $this->receiver = $receiver;
        $this->subject = __('mails/interview.title_accepted');
    }

    public function build()
    {
        return $this->view('mails.interview_accepted')
            ->from('no-reply@niksvoorniks.nl')
            ->replyTo('info@niksvoorniks.nl');
    }
}
