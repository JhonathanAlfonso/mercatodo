<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();

            $table->string('order_number');
            $table->unsignedBigInteger('user_id');
            $table->enum('status', ['pending', 'processing', 'completed', 'decline'])->default('pending');
            $table->float('grand_total');
            $table->integer('item_count');
            $table->boolean('is_paid')->default(false);

            $table->string('shipping_name');
            $table->string('shipping_email');
            $table->string('shipping_phone');
            $table->string('shipping_address');
            $table->string('shipping_city');
            $table->string('shipping_postal');
            $table->string('shipping_country');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
