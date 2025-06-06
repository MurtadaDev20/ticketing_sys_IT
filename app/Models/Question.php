<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'survey_id',
        'question_text',
        'question_type',
        'required',
    ];
    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    public function options()
    {
        return $this->hasMany(Option::class);
    }

    
    protected $casts = [
        'required' => 'boolean',
    ];
    

}
