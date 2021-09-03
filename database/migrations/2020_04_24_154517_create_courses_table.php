<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('instructor_id');
            $table->json('name');
            $table->json('excerpt');
            $table->string('thumbnail');
            $table->json('description');
            $table->unsignedTinyInteger('total_chapters')->default(0);
            $table->unsignedDecimal('average_rate')->nullable();
            $table->json('currency_id');
            $table->json('price')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();


            $table->foreign('instructor_id')
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
        Schema::dropIfExists('course');
    }
}
