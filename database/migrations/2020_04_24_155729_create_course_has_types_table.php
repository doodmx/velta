<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseHasTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_has_types', function (Blueprint $table) {


            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('course_type_id');
            $table->timestamps();


            $table->foreign('course_id')
                ->references('id')->on('course')
                ->onDelete('cascade');

            $table->foreign('course_type_id')
                ->references('id')->on('course_type')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_has_types');
    }
}
