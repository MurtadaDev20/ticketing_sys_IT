<?php

namespace App\Jobs;

use App\Mail\TicketCreatedMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendTicketEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $ticket;

    public function __construct($ticket)
    {
        $this->ticket = $ticket;
    }

    public function handle()
    {
        $primaryRecipient = ['murtadait20@gmail.com', 'murtada.luqman@mansourbank.com'];

        Mail::to($primaryRecipient)->send(new TicketCreatedMail($this->ticket));
    }
}
