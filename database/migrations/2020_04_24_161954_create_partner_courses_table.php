<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_course', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('partner_id');
            $table->unsignedBigInteger('course_id');
            $table->string('approval_certificate')->nullable();
            $table->unsignedBigInteger('last_chapter')->nullable();
            $table->decimal('chapter_progress', 10, 2)->default(0);
            $table->decimal('rate', 10, 2)->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();


            $table->foreign('partner_id')
                ->references('id')->on('user')
                ->onDelete('restrict');

            $table->foreign('course_id')
                ->references('id')->on('course')
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
        Schema::dropIfExists('partner_course');
    }
}
