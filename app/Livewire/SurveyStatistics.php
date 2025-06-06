<?php

namespace App\Livewire;

use App\Models\Survey;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class SurveyStatistics extends Component
{
    public $survey;
    public $statistics = [];

    public function mount(Survey $survey)
    {
        $this->survey = $survey->load(['questions.options', 'responses.answers']);
        $this->generateStatistics();
    }

    public function generateStatistics()
    {
        $this->statistics = [];
        $totalResponses = $this->survey->responses->count();

        foreach ($this->survey->questions as $question) {
            $questionStats = [
                'question' => $question,
                'total_responses' => $totalResponses,
                'answered_count' => 0,
                'skip_rate' => 0,
                'data' => []
            ];

            // Get all answers for this question
            $answers = $question->answers()->with('response')->get();
            $questionStats['answered_count'] = $answers->count();
            $questionStats['skip_rate'] = $totalResponses > 0 ? 
                round((($totalResponses - $answers->count()) / $totalResponses) * 100, 1) : 0;

            switch ($question->question_type) {
                case 'radio':
                case 'select':
                    $questionStats['data'] = $this->getChoiceStatistics($answers, $question);
                    break;
                    
                case 'checkbox':
                    $questionStats['data'] = $this->getCheckboxStatistics($answers, $question);
                    break;
                    
                case 'text':
                case 'textarea':
                    $questionStats['data'] = $this->getTextStatistics($answers);
                    break;
                    
                case 'number':
                    $questionStats['data'] = $this->getNumberStatistics($answers);
                    break;
                    
                case 'date':
                    $questionStats['data'] = $this->getDateStatistics($answers);
                    break;
            }

            $this->statistics[] = $questionStats;
        }
    }

    private function getChoiceStatistics($answers, $question)
    {
        $choices = [];
        $totalAnswers = $answers->count();

        // Initialize with all options
        foreach ($question->options as $option) {
            $choices[$option->option_text] = ['count' => 0, 'percentage' => 0];
        }

        // Count actual answers
        foreach ($answers as $answer) {
            $answerText = trim($answer->answer_text);
            if (isset($choices[$answerText])) {
                $choices[$answerText]['count']++;
            } else {
                $choices[$answerText] = ['count' => 1, 'percentage' => 0];
            }
        }

        // Calculate percentages
        foreach ($choices as $choice => &$data) {
            $data['percentage'] = $totalAnswers > 0 ? 
                round(($data['count'] / $totalAnswers) * 100, 1) : 0;
        }

        // Sort by count descending
        uasort($choices, function($a, $b) {
            return $b['count'] - $a['count'];
        });

        return $choices;
    }

    private function getCheckboxStatistics($answers, $question)
    {
        $choices = [];
        $totalSelections = 0;

        // Initialize with all options
        foreach ($question->options as $option) {
            $choices[$option->option_text] = ['count' => 0, 'percentage' => 0];
        }

        // Count selections
        foreach ($answers as $answer) {
            $selectedOptions = array_map('trim', explode(',', $answer->answer_text));
            $totalSelections += count($selectedOptions);
            
            foreach ($selectedOptions as $option) {
                if (isset($choices[$option])) {
                    $choices[$option]['count']++;
                } else {
                    $choices[$option] = ['count' => 1, 'percentage' => 0];
                }
            }
        }

        // Calculate percentages based on total responses (not selections)
        $totalResponses = $answers->count();
        foreach ($choices as $choice => &$data) {
            $data['percentage'] = $totalResponses > 0 ? 
                round(($data['count'] / $totalResponses) * 100, 1) : 0;
        }

        // Sort by count descending
        uasort($choices, function($a, $b) {
            return $b['count'] - $a['count'];
        });

        return [
            'choices' => $choices,
            'total_selections' => $totalSelections,
            'avg_selections_per_response' => $answers->count() > 0 ? 
                round($totalSelections / $answers->count(), 1) : 0
        ];
    }

    private function getTextStatistics($answers)
    {
        $responses = $answers->pluck('answer_text')->toArray();
        $wordCounts = array_map('str_word_count', $responses);
        $charCounts = array_map('strlen', $responses);

        return [
            'total_responses' => count($responses),
            'avg_word_count' => count($wordCounts) > 0 ? round(array_sum($wordCounts) / count($wordCounts), 1) : 0,
            'avg_char_count' => count($charCounts) > 0 ? round(array_sum($charCounts) / count($charCounts), 1) : 0,
            'longest_response' => count($charCounts) > 0 ? max($charCounts) : 0,
            'shortest_response' => count($charCounts) > 0 ? min($charCounts) : 0,
            'sample_responses' => array_slice($responses, 0, 5) // First 5 responses as samples
        ];
    }

    private function getNumberStatistics($answers)
    {
        $numbers = $answers->pluck('answer_text')
            ->filter(function($value) {
                return is_numeric($value);
            })
            ->map(function($value) {
                return (float) $value;
            })
            ->toArray();

        if (empty($numbers)) {
            return ['no_data' => true];
        }

        return [
            'count' => count($numbers),
            'min' => min($numbers),
            'max' => max($numbers),
            'average' => round(array_sum($numbers) / count($numbers), 2),
            'median' => $this->calculateMedian($numbers),
            'sum' => array_sum($numbers)
        ];
    }

    private function getDateStatistics($answers)
    {
        $dates = $answers->pluck('answer_text')
            ->filter(function($date) {
                return strtotime($date) !== false;
            })
            ->map(function($date) {
                return strtotime($date);
            })
            ->sort()
            ->toArray();

        if (empty($dates)) {
            return ['no_data' => true];
        }

        return [
            'count' => count($dates),
            'earliest' => date('Y-m-d', min($dates)),
            'latest' => date('Y-m-d', max($dates)),
            'date_range_days' => round((max($dates) - min($dates)) / (60 * 60 * 24))
        ];
    }

    private function calculateMedian($numbers)
    {
        sort($numbers);
        $count = count($numbers);
        $middle = floor($count / 2);
        
        if ($count % 2 == 0) {
            return ($numbers[$middle - 1] + $numbers[$middle]) / 2;
        } else {
            return $numbers[$middle];
        }
    }

    public function render()
    {
        return view('livewire.survey-statistics');
    }
}