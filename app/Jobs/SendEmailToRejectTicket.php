<?php

namespace App\Jobs;

use App\Mail\MailToApprovedBy;
use App\Mail\MailToReject;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailToRejectTicket implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $ticket;

    public function __construct($ticket)
    {
        $this->ticket = $ticket;
    }

    public function handle()
    {
        $primaryRecipient = [$this->ticket->user->email];

        Mail::to($primaryRecipient)->send(new MailToReject($this->ticket));
    }
}
