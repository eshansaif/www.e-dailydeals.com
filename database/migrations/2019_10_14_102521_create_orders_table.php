<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('user_email');
            $table->string('name');
            $table->string('phone');
            $table->text('address');
            $table->string('zip');
            $table->string('city');
            $table->string('district');
            $table->string('country');
            $table->float('shipping_charges');
            $table->string('coupon_code');
            $table->float('coupon_amount');
            $table->string('order_status');
            $table->string('payment_method');
            $table->float('grand_total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
