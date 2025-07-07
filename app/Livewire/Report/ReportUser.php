<?php

namespace App\Livewire\Report;

use App\Models\ReportUser as ModelsReportUser;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ReportUser extends Component
{
    use WithPagination;

    public $users;
    public $selectedUser ,$selectStatus;
    
    public function mount()
    {
        $this->users = User::where('status','1')->get();
    }

    public function addSurvayUser()
    {
        $this->validate([
            'selectedUser' => 'required|exists:users,id',
            'selectStatus' =>'required|numeric'
        ]);

        ModelsReportUser::UpdateOrCreate(
            [
            'user_id' => $this->selectedUser,
            ],
            [
            'status' => $this->selectStatus
            ]
    );

        session()->flash('success', 'Report User added successfully.');
        $this->reset([ 'selectedUser','selectStatus']);
    }

    public function render()
    {
        return view('livewire.report.report-user',[
            'reports' => ModelsReportUser::with(['user'])->latest()->paginate(10)
        ]);
    }
}
