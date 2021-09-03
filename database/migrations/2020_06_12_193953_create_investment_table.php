<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('plan_id');
            $table->unsignedBigInteger('currency_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->double('balance');
            $table->double('profit_percentage');
            $table->integer('period_in_years');
            $table->enum('status', ['finalized', 'on_progress', 'pendant']);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();

            $table->foreign('user_id')
                ->references('id')
                ->on('user')
                ->onDelete('restrict');

            $table->foreign('plan_id')
                ->references('id')
                ->on('plan')
                ->onDelete('restrict');

            $table->foreign('currency_id')
                ->references('id')
                ->on('currency')
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
        Schema::dropIfExists('investment');
    }
}
