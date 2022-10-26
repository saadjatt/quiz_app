<?php

namespace App\Http\Controllers;

use App\Models\QuizQuestion;
use App\Models\QuizQuestionOption;
use Exception;
use Illuminate\Http\Request;

class QuizQuestionOptionController extends Controller
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
            'option_title' => ['required','string'],
        ]);
        try {
            // return $request->user();
            $quizQuestiionOption = new QuizQuestionOption();
            $quizQuestiionOption->fill($request->all());
            $quizQuestiionOption->quizQuestion()->associate(QuizQuestion::query()->find($request->quiz_question_id));
            $quizQuestiionOption->save();
            
            return response()->json($quizQuestiionOption);
        } catch (Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QuizQuestionOption  $quizQuestionOption
     * @return \Illuminate\Http\Response
     */
    public function show(QuizQuestionOption $quizQuestionOption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QuizQuestionOption  $quizQuestionOption
     * @return \Illuminate\Http\Response
     */
    public function edit(QuizQuestionOption $quizQuestionOption)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QuizQuestionOption  $quizQuestionOption
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuizQuestionOption $quizQuestionOption)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QuizQuestionOption  $quizQuestionOption
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuizQuestionOption $quizQuestionOption)
    {
        //
    }
}
