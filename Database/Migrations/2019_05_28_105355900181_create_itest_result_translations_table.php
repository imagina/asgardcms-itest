<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItestResultTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itest__result_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('description');
            $table->integer('result_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['result_id', 'locale']);
            $table->foreign('result_id')->references('id')->on('itest__results')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('itest__result_translations', function (Blueprint $table) {
            $table->dropForeign(['result_id']);
        });
        Schema::dropIfExists('itest__result_translations');
    }
}
