<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('buyer_id');
            $table->string('payment_uuid')->nullable();
            $table->enum('payment_method', ['stripe_credit_card', 'paypal'])->default('stripe_credit_card');
            $table->unsignedBigInteger('currency_id');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('discount', 10, 2)->nullable();
            $table->decimal('tax', 10, 2);
            $table->decimal('total', 10, 2);
            $table->enum('status', ['paid', 'pendant', 'verified'])->default('paid');

            $table->timestamps();


            $table->foreign('buyer_id')
                ->references('id')
                ->on('user')
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
        Schema::dropIfExists('cart');
    }
}
