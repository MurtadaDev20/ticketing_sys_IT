<?php

namespace App\Livewire\Report;

use App\Models\Report;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class ReportShowCreator extends Component
{
    use WithPagination;
    public function render()
    {
        $reports = Report::where('user_id', Auth::id())
        ->latest()
        ->with(['user'])
        ->paginate(20);
        return view('livewire.report.report-show-creator', [
            'reports' => $reports,
        ]);
    }
}
