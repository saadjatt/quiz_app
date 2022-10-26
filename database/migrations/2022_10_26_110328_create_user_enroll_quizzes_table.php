<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserEnrollQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_enroll_quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained("quizzes")->cascadeOnDelete();
            $table->foreignId('user_id')->constrained("users")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_enroll_quizzes');
    }
}
