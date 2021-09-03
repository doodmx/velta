<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $languages = array_column(config('locale.languages'), 0);
        $memberships = array_keys(config('memberships'));


        Schema::create('user', function (Blueprint $table) use ($languages, $memberships) {
            $table->id('id');
            $table->unsignedBigInteger('partner_id')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->string('status')->nullable();
            $table->text('notes')->nullable();
            $table->enum('membership', $memberships)->nullable();
            $table->enum('locale', $languages)->default('es');
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('partner_id')
                ->references('id')
                ->on('user')
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
        Schema::dropIfExists('user');
    }
}
