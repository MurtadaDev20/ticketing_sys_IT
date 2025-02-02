<?php

namespace App\Jobs;

use App\Mail\MailToApprovedBy;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailToApprovedBy implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $ticket;

    public function __construct($ticket)
    {
        $this->ticket = $ticket;
    }

    public function handle()
    {
        $primaryRecipient = [$this->ticket->user->email, 'murtadait20@gmail.com'];

        Mail::to($primaryRecipient)->send(new MailToApprovedBy($this->ticket));
    }
}
