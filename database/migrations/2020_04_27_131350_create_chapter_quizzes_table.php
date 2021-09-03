<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChapterQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapter_quiz', function (Blueprint $table) {
            $table->unsignedBigInteger('chapter_id')->primary();
            $table->json('name');
            $table->json('briefing');
            $table->unsignedTinyInteger('total_credits');
            $table->unsignedTinyInteger('credits_to_approve');

            $table->timestamps();

            $table->foreign('chapter_id')
                ->references('id')->on('course_chapter')
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
        Schema::dropIfExists('chapter_quiz');
    }
}
