<?php

namespace App\Http\Controllers;

use App\Models\QuizAnswer;
use App\Models\QuizQuestion;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class QuizAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'quiz_question_id' => ['required', 'exists:quiz_questions,id', 'numeric'],
            'user_answer' => ['required','string']
        ]);
        try {
             //return $request->user();
            $quizAnswer = new QuizAnswer();
            $quizAnswer->fill($request->all());
            $quizAnswer->quizQuestion()->associate(QuizQuestion::query()->find($request->quiz_question_id));
            $quizAnswer->user()->associate($request->user());
            $quizAnswer->save();
            

            return response()->json($quizAnswer);
        } catch (Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QuizAnswer  $quizAnswer
     * @return \Illuminate\Http\Response
     */
    public function show(QuizAnswer $quizAnswer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QuizAnswer  $quizAnswer
     * @return \Illuminate\Http\Response
     */
    public function edit(QuizAnswer $quizAnswer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QuizAnswer  $quizAnswer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuizAnswer $quizAnswer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QuizAnswer  $quizAnswer
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuizAnswer $quizAnswer)
    {
        //
    }
}
