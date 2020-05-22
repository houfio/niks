<?php

namespace App\Mail;

use App\Interview;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InterviewMail extends Mailable
{
    use Queueable, SerializesModels;

    public Interview $interview;
    public string $token;

    public function __construct(Interview $interview, string $token)
    {
        $this->interview = $interview;
        $this->token = $token;
        $this->subject = __('mails/interview.title_requested');
    }

    public function build()
    {
        return $this->view('mails.interview_requested')
            ->from('no-reply@niksvoorniks.nl')
            ->replyTo('info@niksvoorniks.nl');
    }
}
