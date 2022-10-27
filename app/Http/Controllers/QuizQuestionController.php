<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use Exception;
use Illuminate\Http\Request;

class QuizQuestionController extends Controller
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
            'quiz_id' => ['required', 'exists:quizzes,id', 'numeric'],
            'type' => ['required','string'],
            'title' => ['required','string'],
            'answer' => ['required']
        ]);
        try {
            // return $request->user();
            $quizQuestiion = new QuizQuestion();
            $quizQuestiion->fill($request->all());
            $quizQuestiion->quiz()->associate(Quiz::query()->find($request->quiz_id));
            $quizQuestiion->save();
            
            return response()->json($quizQuestiion);
        } catch (Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QuizQuestion  $quizQuestion
     * @return \Illuminate\Http\Response
     */
    public function show(QuizQuestion $quizQuestion)
    {
        //
        return $quizQuestion->get();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QuizQuestion  $quizQuestion
     * @return \Illuminate\Http\Response
     */
    public function edit(QuizQuestion $quizQuestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QuizQuestion  $quizQuestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuizQuestion $quizQuestion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QuizQuestion  $quizQuestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuizQuestion $quizQuestion)
    {
        //
    }
}
