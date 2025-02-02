<?php

namespace App\Jobs;

use App\Mail\TicketCreateMailToApproved;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendTicketEmailToApproved implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $ticket;
    protected $approver;

    public function __construct($ticket, $approver)
    {
        $this->ticket = $ticket;
        $this->approver = $approver;
    }

    public function handle()
    {
        $primaryRecipient = $this->approver->email;

        Mail::to($primaryRecipient)->send(new TicketCreateMailToApproved($this->ticket));
    }
}
