<?php

namespace App\Exports;

namespace App\Exports;

use App\Models\Survey;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AnswersSurveyExport implements FromCollection, WithHeadings
{
    protected $surveyId;

    public function __construct($surveyId)
    {
        $this->surveyId = $surveyId;
    }

    public function collection()
    {
        $survey = Survey::with(['questions', 'responses.answers'])->findOrFail($this->surveyId);
        $questions = $survey->questions;

        $exportData = $survey->responses->map(function ($response) use ($questions) {
            $row = [
                'Response ID' => $response->id,
                'Submitted At' => $response->created_at->toDateTimeString(),
            ];

            foreach ($questions as $question) {
                $answer = $response->answers->firstWhere('question_id', $question->id);
                $row[$question->question_text] = $answer ? $answer->answer_text : 'No Answer';
            }

            return $row;
        });

        return $exportData;
    }

    public function headings(): array
    {
        $survey = Survey::with('questions')->findOrFail($this->surveyId);
        $headings = ['Response ID', 'Submitted At'];

        foreach ($survey->questions as $question) {
            $headings[] = $question->question_text;
        }

        return $headings;
    }
}
