<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'title', 'answer'];

    public function quiz(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    public function quizAnswer()
    {
        return $this->hasMany(QuizAnswer::class);
    }

    public function quizQuestionOption()
    {
        return $this->hasMany(QuizQuestionOption::class);
    }
}
