<?php

namespace App\Livewire\Report;

use App\Jobs\AprovedOnReport;
use App\Models\Report;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class ReportShowAdmin extends Component
{
    use WithPagination;
    public function render()
    {
        $reports = Report::with(['user'])
        ->orderByRaw("FIELD(status, '2', '1', '3')")
        ->latest()
        ->paginate(20);
        return view('livewire.report.report-show-admin', [
            'reports' => $reports,
        ]);
    }

    public function approvedReport($id)
    {
        $report = Report::find($id);
        $report->status = '1';
        $report->save();
        toastr()->success('Report Approved Successfully');

        // Dispatch the job to send email to the report creator
        $responseCreator = $report->user_id;
        AprovedOnReport::dispatch($report, $responseCreator);
    }
}
