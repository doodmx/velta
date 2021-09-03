<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseDoubtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_doubt', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('partner_id');
            $table->string('title');
            $table->text('content');
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('course_id')
                ->references('id')->on('course')
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
        Schema::dropIfExists('course_doubt');
    }
}
