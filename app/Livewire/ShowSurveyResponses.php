<?php

namespace App\Livewire;

use App\Exports\AnswersSurveyExport;
use App\Models\Survey;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ShowSurveyResponses extends Component
{
    use WithPagination;

    public $survey;

    public function mount(Survey $survey)
    {
        $this->survey = $survey->load(['questions.options']);
    }

    public function closeSurvey()
    {
        $this->survey->update(['status' => false]);
        toastr()->success('Survey has been closed successfully.');
        // session()->flash('message', 'Survey has been closed successfully.');
    }

    public function openSurvey()
    {
        $this->survey->update(['status' => true]);
        toastr()->success('Survey has been opened successfully.');
        // session()->flash('message', 'Survey has been opened successfully.');
    }

    public function exportData()
    {
        $random = time();
        return Excel::download(new AnswersSurveyExport($this->survey->id), 'Survey-Responses-'. $random .'.xlsx');
    }

     public function showStatistics()
    {
        return $this->redirect(route('survey.statistics', $this->survey->id));
    }
    
    public function render()
    {
        $responses = $this->survey->responses()->with('answers')->paginate(20);
        return view('livewire.show-survey-responses' , [
            'responses' => $responses
        ]);
    }
}
