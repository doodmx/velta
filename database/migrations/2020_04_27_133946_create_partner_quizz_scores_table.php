<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerQuizzScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_quiz_score', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('partner_id');
            $table->unsignedBigInteger('chapter_quiz_id');
            $table->string('feedback');
            $table->decimal('score', 10, 2);
            $table->timestamps();


            $table->foreign('partner_id')
                ->references('id')->on('user')
                ->onDelete('restrict');

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
        Schema::dropIfExists('partner_quiz_score');
    }
}
