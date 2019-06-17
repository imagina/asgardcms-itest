<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItestQuizTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itest__quiz_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('title');
            $table->text('slug');
            $table->text('description');
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('translatable_options')->nullable();
            $table->integer('quiz_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['quiz_id', 'locale']);
            $table->foreign('quiz_id')->references('id')->on('itest__quizzes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('itest__quiz_translations', function (Blueprint $table) {
            $table->dropForeign(['quiz_id']);
        });
        Schema::dropIfExists('itest__quiz_translations');
    }
}
