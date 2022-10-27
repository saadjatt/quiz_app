<?php

namespace App\Http\Controllers;

use App\Models\NotificationEmail;
use App\Models\Quiz;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Quiz::query()->with(['quizQuestion', 'quizQuestion.quizQuestionOption'])->get());
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
            'title' => ['required', 'string'],
           
        ]);
        //print_r($request->user());die;
        try {
            // return $request->user();
            $quiz = new Quiz();
            $quiz->fill($request->all());
            $quiz->user()->associate($request->user());
            $quiz->save();
            
            $users = User::query()->where("active",1)->get();
            foreach ($users as $user) {
                $notify_email = new  NotificationEmail();
                $notify_email->user_id=$user->id;
                $notify_email->quiz_id=$quiz->id;
                $notify_email->is_sent=0;
                $notify_email->save();
            }
            return response()->json($quiz);
        } catch (Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function show(Quiz $quiz)
    {
        return $quiz->with(['quizQuestion', 'quizQuestion.quizQuestionOption'])->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function edit(Quiz $quiz)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quiz $quiz)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quiz $quiz)
    {
        //
    }

    public function getResult(Request $request)
    {    
        try{
        
            $request->validate([
                'user_id' => ['nullable', 'exists:users,id','numeric'],
                'quiz_id' => ['required', 'exists:quizzes,id','numeric'],
            ]);

            $str = ''.$request->user()->id;
            if($request->has('user_id')){
                $str = ''.$request->user_id;
            }

            return response()->json(DB::select('Select q.title,(Select count(*) from quiz_questions qq where qq.quiz_id='. $request->quiz_id .') as "Total Question",(Select count(*) from quiz_questions qq
            join quiz_answers qa ON qa.quiz_question_id =qq.id where qq.quiz_id='. $request->quiz_id .') as "User Attempted",(Select count(*) from quiz_questions qq join
            quiz_answers qa ON qa.quiz_question_id =qq.id where qq.quiz_id=1 and qa.user_answer=qq.answer) as "Correct Answer" 
            from quizzes q where q.id='. $request->quiz_id .' and q.user_id = '.$str));
        }
        catch (Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }

        
    }


    public function getHistory(Request $request)
    {    
        try{
        
            
            return response()->json(DB::select('Select u.name, u.email,q.title as "Quiz Title",
            (Select qaa.created_at  from quiz_answers qaa where qa.user_id=u.id limit 1) as "Created At"
            from quizzes q 
            join quiz_questions qq ON q.id =qq.quiz_id 
            join quiz_answers qa on qa.quiz_question_id =qq.id 
            join users u on qa.user_id  =u.id 
            group by qa.user_id, qq.quiz_id 
            '));
        }
        catch (Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }

        
    }

}