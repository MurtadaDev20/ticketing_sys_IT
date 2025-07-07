<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailAprovedOnReport extends Mailable
{
    use Queueable, SerializesModels;

    public $report;
    public function __construct( $report )
    {
        $this->report = $report;
    }

    public function build()
    {
        return $this->subject('Report Approved Notification')
                    ->view('emails.mail_approved_report')
                    ->with([
                        'reportName' => $this->report->name,
                        'reportHeader' => $this->report->header,
                        'reportTypeDate' => $this->report->type_date,
                        'reportReasonRequest' => $this->report->reson_request,
                        'reportStatus' => $this->report->status,
                        'reportNotes' => $this->report->notes,
                        'reportDateFrom' => $this->report->date_from,
                        'reportDateTo' => $this->report->date_to,
                        'reportDate' => $this->report->date,
                        'reportClosedAt' => $this->report->closed_at,
                        'reportCreator' => $this->report->user->name,
                        'reportCreatorEmail' => $this->report->user->email,
                        'reportCreatorId' => $this->report->user->id,
                        'reportId' => $this->report->id,
                    ]);
    }
}
