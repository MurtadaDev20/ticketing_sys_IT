<?php

namespace App\Livewire;

use App\Models\Survey;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class SurveyManage extends Component
{
    use WithPagination;
    public $survay_title;
    public $survay_description;

    

    public function addNewSurvay()
    {
        $this->validate([
            'survay_title' => 'required|string|max:255',
            'survay_description' => 'required|string|max:1000',
        ]);

        Survey::Create([
            'user_id' => Auth::user()->id,
            'title' => $this->survay_title,
            'description' => $this->survay_description,
        ]);

        session()->flash('success', 'Survey User added successfully.');
        $this->reset([ 'survay_title', 'survay_description']);
    }

    public function render()
    {
        $surveys = Survey::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        
        return view('livewire.survey-manage', [
            'surveys' => $surveys,
        ]);
    }
}
