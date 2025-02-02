<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketCreateMailToApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;

    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function build()
    {
        return $this->subject('New Ticket Created Need To Approved')
                    ->view('emails.ticket_create_email_to_approve')
                    ->with([
                        'ticketTitle' => $this->ticket->ticket_title,
                        'ticketDescription' => $this->ticket->ticket_desc,
                        'ticketCategory' => $this->ticket->catigory->cat_name,
                        'ticketSubCategory' => $this->ticket->subCategory->sub_cat_name,
                        'ticketUser' => $this->ticket->user->name,
                        'created_at' => $this->ticket->created_at,
                    ]);
    }
}
