<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogSeoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_seo', function (Blueprint $table) {
            $table->unsignedBigInteger('blog_id');
            $table->json('slug');
            $table->json('title');
            $table->json('image_alt');
            $table->json('separator');
            $table->json('description');
            $table->timestamps();

            $table->foreign('blog_id')
                ->references('id')
                ->on('blog')
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
        Schema::dropIfExists('blog_seo');
    }
}
