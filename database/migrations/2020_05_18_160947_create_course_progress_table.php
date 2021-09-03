<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_progress', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('partner_course_id');
            $table->unsignedBigInteger('course_chapter_id');
            $table->timestamps();


            $table->foreign('partner_course_id')
                ->references('id')
                ->on('partner_course')
                ->onDelete('restrict');


            $table->foreign('course_chapter_id')
                ->references('id')
                ->on('course_chapter')
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
        Schema::dropIfExists('course_progress');
    }
}
