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

    public Ticket $ticket;
    public string $response, $token;

    public function __construct(Ticket $ticket, string $response, string $token)
    {
        $this->subject = $ticket;
        $this->response = $response;
    }

    public function build()
    {
        return $this->view('mails.ticket_response')
            ->from('no-reply@niksvoorniks.nl')
            ->replyTo('info@niksvoorniks.nl');
    }
}
