<?php

namespace App\Jobs;

use App\Mail\SendEmailReportCreatorMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendEmailReportCreator implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $report;
    protected $responser;

    public function __construct($report , $responser)
    {
        $this->report = $report;
        $this->responser = $responser;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $primaryRecipient = $this->responser->email;

        Mail::to($primaryRecipient)->send(new SendEmailReportCreatorMail ($this->report ));
    }
}
