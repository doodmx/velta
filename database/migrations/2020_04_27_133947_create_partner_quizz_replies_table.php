<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerQuizzRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_quizz_reply', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quiz_score_id');
            $table->unsignedBigInteger('question_option_id');
            $table->timestamps();

            $table->foreign('quiz_score_id')
                ->references('id')->on('partner_quiz_score')
                ->onDelete('restrict');

            $table->foreign('question_option_id')
                ->references('id')->on('question_option')
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
        Schema::dropIfExists('partner_quizz_reply');
    }
}
