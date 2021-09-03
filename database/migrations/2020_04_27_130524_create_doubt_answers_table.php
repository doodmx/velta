<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoubtAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doubt_answer', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_doubt_id');
            $table->unsignedBigInteger('partner_id');
            $table->string('answer');
            $table->timestamps();

            $table->foreign('course_doubt_id')
                ->references('id')->on('course_doubt')
                ->onDelete('restrict');

            $table->foreign('partner_id')
                ->references('id')->on('user')
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
        Schema::dropIfExists('doubt_answer');
    }
}
