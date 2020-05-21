<?php
namespace App\Mail;

use App\Ticket;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $token;

    public function __construct(Ticket $ticket)
    {
        $this->subject = __('mails/ticket.title') . ': ' . $ticket->subject;
    }

    public function build()
    {
        return $this->view('mails.ticket')
            ->from('no-reply@niksvoorniks.nl')
            ->replyTo('info@niksvoorniks.nl');
    }
}
