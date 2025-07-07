<?php

namespace App\Jobs;

use App\Mail\MailAprovedOnReport;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class AprovedOnReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $report;
    public $responseCreator;
    public function __construct( $report, $responseCreator)
    {
        $this->report = $report;
        $this->responseCreator = $responseCreator;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Send email to the report creator
        $user = User::find($this->responseCreator);
        
        $primaryRecipient = $user->email;

        Mail::to($primaryRecipient)->send(new MailAprovedOnReport($this->report));
        
    }
}
