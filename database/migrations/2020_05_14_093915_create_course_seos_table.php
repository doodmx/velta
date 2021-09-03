<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseSeosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_seo', function (Blueprint $table) {

            $table->unsignedBigInteger('course_id');
            $table->json('slug');
            $table->json('title');
            $table->json('image_alt');
            $table->json('separator');
            $table->json('description');
            $table->timestamps();

            $table->foreign('course_id')
                ->references('id')
                ->on('course')
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
        Schema::dropIfExists('course_seo');
    }
}
