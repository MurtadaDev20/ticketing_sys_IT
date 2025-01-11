<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketClosed extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;

    /**
     * Create a new message instance.
     */
    public function __construct($ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Ticket Closed')
                    ->view('emails.ticket_closed')
                    ->with([
                        'ticketTitle' => $this->ticket->ticket_title,
                        'CloseTicketBy' => $this->ticket->support->name,
                        'comment' => $this->ticket->comment->comment,
                        'closeAt' => $this->ticket->close_ticket_at,
                    ]);
    }
}
