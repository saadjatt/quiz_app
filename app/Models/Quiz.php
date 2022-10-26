<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function quizQuestion(){
        return $this->hasMany(QuizQuestion::class);
    }
    
    public function userEnrolled()
    {
        return $this->belongsToMany(User::class, 'user_enroll_quizzes', 'quiz_id','user_id');
    }

    // public function getCreatedAtAttribute($value)
    // {
    //     return Carbon::parse($value)->toDayDateTimeString();
    // }
}
