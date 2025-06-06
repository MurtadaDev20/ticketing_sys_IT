<?php

namespace App\Livewire;

use App\Models\SurveyAllowUser;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class SurveyAlowUser extends Component
{
    use WithPagination;
    public $users;
    public $selectedUser;

    public function mount()
    {
        $this->users = User::where('status','1')->get();
    }

    public function addSurvayUser()
    {
        $this->validate([
            'selectedUser' => 'required|exists:users,id',
        ]);

        SurveyAllowUser::UpdateOrCreate([
            'user_id' => $this->selectedUser,
        ]);

        session()->flash('success', 'Survey User added successfully.');
        $this->reset([ 'selectedUser']);
    }

    
    public function render()
    {
        return view('livewire.survey-alow-user', [
            'surveys' => SurveyAllowUser::with(['user'])->latest()->paginate(10)
        ]);
    }
}
