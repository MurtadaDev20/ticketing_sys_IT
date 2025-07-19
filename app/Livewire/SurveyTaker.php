<?php

namespace App\Livewire;

use App\Models\Survey;
use App\Models\Response;
use App\Models\Answer;
use App\Models\Option;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SurveyTaker extends Component
{
    public Survey $survey;
    public $answers = [];

    protected $rules = [];
    protected $messages = [];

    public function mount(Survey $survey)
    {
        $this->survey = $survey;

        // Initialize validation rules and messages
        $this->initializeValidation();

        $existing = Response::where('survey_id', $survey->id)
                        ->where('user_id', Auth::id())
                        ->first();

        if ($existing) {

            toastr()->error('You have already submitted this survey.');
            return redirect()->route('user.surveyViewUser');
        }

        if($survey->status == 0)
        {
            toastr()->error('Sorry The Survey has been closed.');
            return redirect()->route('user.surveyViewUser');
        }
    }

    protected function initializeValidation()
    {
        $this->rules = [];
        $this->messages = [];

        foreach ($this->survey->questions as $question) {
            if ($question->required) {
                if ($question->question_type === 'checkbox') {
                    $this->rules["answers.{$question->id}"] = 'required|array|min:1';
                    $this->messages["answers.{$question->id}.required"] = "Please select at least one option for: {$question->question_text}";
                    $this->messages["answers.{$question->id}.min"] = "Please select at least one option for: {$question->question_text}";
                } else {
                    $this->rules["answers.{$question->id}"] = 'required';
                    $this->messages["answers.{$question->id}.required"] = "Please answer this required question: {$question->question_text}";
                }
            }
        }
    }

    public function submit()
    {
        $this->initializeValidation(); // Refresh rules in case questions changed
        $this->validate();

        // Check if user already submitted
        $existingResponse = Response::where('survey_id', $this->survey->id)
                                ->where('user_id', Auth::id())
                                ->first();

        if ($existingResponse) {
            session()->flash('error', 'You have already submitted this survey.');
            return;
        }

        $response = Response::create([
            'survey_id' => $this->survey->id,
            'user_id' => Auth::id(),
            'status' => 'completed', 
        ]);

        foreach ($this->survey->questions as $question) {
            $rawAnswer = $this->answers[$question->id] ?? null;

            if ($question->question_type === 'checkbox') {
                // Handle checkbox answers
                $selectedOptions = collect($rawAnswer ?? [])
                    ->filter(fn($checked) => $checked)
                    ->keys()
                    ->toArray();

                $optionTexts = Option::whereIn('id', $selectedOptions)
                    ->pluck('option_text')
                    ->toArray();

                $answerText = implode(', ', $optionTexts);
            } else {
                $answerText = $rawAnswer;
            }
            
            if (!empty($answerText)) {
                Answer::create([
                    'response_id' => $response->id,
                    'question_id' => $question->id,
                    'answer_text' => $answerText,
                ]);
            }
        }

        // session()->flash('success', 'Survey submitted successfully!');
        // $this->reset('answers');
        return redirect()->route('survey.thank-you');
    }

    public function render()
    {
        return view('livewire.survey-taker');
    }
}