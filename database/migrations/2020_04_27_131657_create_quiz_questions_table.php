<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_question', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chapter_quiz_id');
            $table->json('name');
            $table->enum('type', ['radio', 'checkbox'])->default('checkbox');
            $table->unsignedTinyInteger('order')->index();
            $table->unsignedTinyInteger('credits');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('chapter_quiz_id')
                ->references('chapter_id')->on('chapter_quiz')
                ->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_question');
    }
}
