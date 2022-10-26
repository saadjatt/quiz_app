<?php

use App\Http\Controllers\FeaturedImageController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FrameworkController;
use App\Http\Controllers\HandleFileController;
use App\Http\Controllers\OperatingSystemController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductSubcategoryController;
use App\Http\Controllers\ProductTemplateController;
use App\Http\Controllers\ScreenshotController;
use App\Http\Controllers\ThumbnailImageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthController;
use \App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactUSController;
use App\Http\Controllers\Guarantee100Controller;
use \App\Http\Controllers\SliderController;
use App\Models\ProductDocs;
use App\Http\Controllers\ProductDocsController;
use App\Http\Controllers\QuizAnswerController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizQuestionController;
use App\Http\Controllers\QuizQuestionOptionController;
use App\Models\Quiz;
use App\Models\QuizQuestion;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login']);
Route::post('/sign-up', [AuthController::class, 'signUp']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


// 
Route::resource('/quiz', QuizController::class)->only(['index', 'show']);
Route::resource('/quiz-question', QuizQuestionController::class)->only(['index', 'show']);
Route::resource('/quiz-question-option', QuizQuestionOptionController::class)->only(['index', 'show']);
Route::resource('/quiz-answer', QuizAnswerController::class)->only(['index', 'show']);


Route::middleware('auth:sanctum')->prefix('auth')->group(function () {

    Route::post('/result',[QuizController::class, 'getResult']);
    Route::resource('/quiz', QuizController::class)->except(['index', 'show']);
    Route::resource('/quiz-question', QuizQuestionController::class)->except(['index', 'show']);
    Route::resource('/quiz-question-option', QuizQuestionOptionController::class)->except(['index', 'show']);
    Route::resource('/quiz-answer', QuizAnswerController::class)->except(['index', 'show']);

});