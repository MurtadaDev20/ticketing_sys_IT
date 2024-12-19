<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketAssigned extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;

    /**
     * Create a new message instance.
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('New Ticket')
                    ->view('emails.ticket_assigned')
                    ->with([
                        'ticketTitle' => $this->ticket->ticket_title,
                        'ticketDescription' => $this->ticket->ticket_desc,
                        'ticketCategory' => $this->ticket->catigory->cat_name,
                        'ticketUser' => $this->ticket->user->name,
                        'created_at' => $this->ticket->created_at,
                    ]);
    }
}
