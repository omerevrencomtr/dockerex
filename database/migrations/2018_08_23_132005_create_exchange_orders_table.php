<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExchangeOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchange_orders', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->uuid('exchange_id')->index();
            $table->uuid('user_id')->index();
            $table->unsignedDecimal('commission', 15, 8);
            $table->enum('direction', ['buy', 'sell'])->index();
            $table->unsignedDecimal('amount', 15, 8)->index();
            $table->unsignedDecimal('price', 15, 8)->index();
            $table->timestamps();

            $table->foreign('exchange_id')->references('id')->on('exchanges');
            $table->foreign('user_id')->references('id')->on('users');

            $table->index(['created_at']);



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exchange_orders');
    }
}
