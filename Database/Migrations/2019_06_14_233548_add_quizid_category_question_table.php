<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQuizidCategoryQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('itest__categories', function (Blueprint $table) {
            $table->integer('quiz_id')->unsigned()->nullable();
            $table->foreign('quiz_id')->references('id')->on('itest__quizzes')->onDelete('restrict');
        });

        Schema::table('itest__questions', function (Blueprint $table) {
            $table->integer('quiz_id')->unsigned()->nullable();
            $table->foreign('quiz_id')->references('id')->on('itest__quizzes')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('itest__categories', function (Blueprint $table) {
           $table->dropColumn('quiz_id');
        });
        Schema::table('itest__questions', function (Blueprint $table) {
            $table->dropColumn('quiz_id');
        });
    }
}
