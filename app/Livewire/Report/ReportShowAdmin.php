<?php

namespace App\Livewire\Report;

use ZipArchive;
use App\Models\Report;
use Livewire\Component;
use App\Models\ReportAttach;
use Livewire\WithPagination;
use App\Jobs\AprovedOnReport;
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

    public function downloadAllFiles(ReportAttach $file)
    {
        $zipFileName = 'report_files_' . now()->timestamp . '.zip';
        $zipPath = storage_path('app/public/' . $zipFileName);

        $zip = new ZipArchive;
        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            foreach ($file->report->attaches as $attach) {
                $filePath = storage_path('app/public/' . $attach->file);
                if (file_exists($filePath)) {
                    $zip->addFile($filePath, basename($filePath));
                }
            }
            $zip->close();
            return response()->download($zipPath)->deleteFileAfterSend(true);
        } else {
            return response()->json(['error' => 'Failed to create zip file.'], 500);
        }
        
    }
}
