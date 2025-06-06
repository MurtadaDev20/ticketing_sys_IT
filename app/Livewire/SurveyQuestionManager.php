<?php

namespace App\Livewire;

use App\Models\Survey;
use App\Models\Question;
use App\Models\Option;
use Livewire\Component;

class SurveyQuestionManager extends Component
{
    public Survey $survey;

    public $question_text = '';
    public $question_type = 'text';
    public $required = false;
    public $options = [];

    public function mount(Survey $survey)
    {
        $this->survey = $survey;
    }

    public function addOption()
    {
        $this->options[] = '';
    }

    public function removeOption($index)
    {
        // Remove the option at the specified index
        unset($this->options[$index]);
        
        // Re-index the array to maintain consecutive keys
        $this->options = array_values($this->options);
    }

    public function addQuestion()
    {
        $this->validate([
            'question_text' => 'required|string|max:255',
            'question_type' => 'required|in:text,radio,checkbox,select',
            'options' => [
                function ($attribute, $value, $fail) {
                    if (in_array($this->question_type, ['radio', 'checkbox', 'select'])) {
                        if (!is_array($value) || empty(array_filter($value))) {
                            $fail('You must add at least one option.');
                        }
                    }
                },
            ],
        ]);

        $question = Question::create([
            'survey_id' => $this->survey->id,
            'question_text' => $this->question_text,
            'question_type' => $this->question_type,
            'required' => $this->required,
        ]);

        if (in_array($this->question_type, ['radio', 'checkbox', 'select'])) {
            foreach ($this->options as $opt) {
                if (trim($opt)) {
                    Option::create([
                        'question_id' => $question->id,
                        'option_text' => $opt,
                    ]);
                }
            }
        }

        // Reset form
        $this->reset(['question_text', 'question_type', 'required', 'options']);
    }

    public function getQuestionsProperty()
    {
        return $this->survey->questions()->with('options')->latest()->get();
    }


    public function deleteQuestion($questionId)
    {
        $question = Question::findOrFail($questionId);
        $question->options()->delete(); // Delete associated options
        $question->delete(); // Delete the question itself

        toastr()->success('Question deleted successfully.');
    }


    public function render()
    {
        return view('livewire.survey-question-manager');
    }
}
