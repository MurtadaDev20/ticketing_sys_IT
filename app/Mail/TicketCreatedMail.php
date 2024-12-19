<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;

    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function build()
    {
        return $this->subject('New Ticket Created Tickit-Sys')
                    ->view('emails.ticket_created')
                    ->with([
                        'ticketTitle' => $this->ticket->ticket_title,
                        'ticketDescription' => $this->ticket->ticket_desc,
                        'ticketCategory' => $this->ticket->catigory->cat_name,
                        'ticketUser' => $this->ticket->user->name,
                        'created_at' => $this->ticket->created_at,
                    ]);
    }
}
