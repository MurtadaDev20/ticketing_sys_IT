<?php

namespace App\Livewire\Report;

use App\Jobs\SendEmailReportCreator;
use App\Models\Report;
use Livewire\Component;
use App\Models\ReportAttach;
use App\Models\ReportUser;
use App\Models\User;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class ReportCreator extends Component
{
    use WithFileUploads;

    public $selectReportType;
    public $folderPath;
    public $reportName;
    public $reportHeaders = [''];
    public $selectReportTypeOfDate;
    public $from;
    public $to;
    public $date;
    public $image = [];
    public $selectReson;
    
    
    protected $rules = [
        'selectReportType' => 'required|in:1,2',
        'reportName' => 'required|string|max:255',
        'selectReportTypeOfDate' => 'required|in:1,2',
        'from' => 'required_if:selectReportTypeOfDate,1|date|nullable',
        'to' => 'required_if:selectReportTypeOfDate,1|date|nullable',
        'date' => 'required_if:selectReportTypeOfDate,2|date|nullable',
        'selectReson' => 'required|in:1,2,3,4',
        'folderPath' => 'nullable|string|max:255',
        'image.*' => 'nullable|file|max:10240', // max 10MB
        'reportHeaders.*' => 'nullable|string|max:255',
    ];

    public function updatedReportHeaders($value, $key)
    {
        // If the user just filled the last item, add a new blank one
        if ($key == count($this->reportHeaders) - 1 && $value !== '') {
            $this->reportHeaders[] = '';
        }
    }
    public function addNewReport()
    {
        
        $this->validate();
        $headersFiltered = array_filter($this->reportHeaders); // Remove empty entries
        $headerString = implode('-', $headersFiltered); // Or use json_encode($headersFiltered)


        $report = Report::create([
            'user_id' => Auth::id(),
            'modification' => $this->selectReportType,
            'folder_path' => $this->folderPath,
            'name' => $this->reportName,
            'header' => $headerString,
            'type_date' => $this->selectReportTypeOfDate,
            'reson_request' => $this->selectReson,
            'status' => 2,  //'delivered 1,awaiting_confirmation 2,rejected 3'
            'date_from' => $this->from,
            'date_to' => $this->to,
            'date' => $this->date,
        ]);

        $AdminReports = ReportUser::where('status', 2)->get();
        // Send email to all approvers
            foreach ($AdminReports as $admin) {
                $responser = User::find($admin->user_id);
                if ($admin) {
                    SendEmailReportCreator::dispatch($report, $responser);
                }
            }

        foreach ($this->image as $file) {
            $filePath = $file->store('report_attaches', 'public');

            ReportAttach::create([
                'report_id' => $report->id,
                'file' => $filePath,
                'uploaded_by' => Auth::id(),
            ]);
        }

        toastr()->success( 'Report created successfully.');
        return redirect()->route('user.reportShowCreator');
    }


    public function render()
    {
        return view('livewire.report.report-creator');
    }
}
