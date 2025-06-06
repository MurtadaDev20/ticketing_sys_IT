<?php

namespace App\Livewire;

use App\Models\Survey;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SurveyViewUesr extends Component
{
    public function render()
    {
        $surveys = Survey::orderBy('created_at', 'desc')
            ->paginate(6);
            
        return view('livewire.survey-view-uesr',
            [
                'surveys' => $surveys,
            ]
        );
    }
}
