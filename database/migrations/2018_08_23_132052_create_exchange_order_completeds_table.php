<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExchangeOrderCompletedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchange_order_completeds', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->uuid('exchange_order_id')->index();
            $table->uuid('exchange_id')->index();
            $table->uuid('user_buying_id')->index();
            $table->uuid('user_selling_id')->index();
            $table->uuid('currency_buying_id')->index();
            $table->uuid('currency_selling_id')->index();
            $table->unsignedDecimal('amount', 15, 8);
            $table->unsignedDecimal('price', 15, 8);
            $table->unsignedDecimal('commission', 15, 8);
            $table->enum('direction', ['buy', 'sell']);
            $table->timestamps();

            $table->foreign('user_buying_id')->references('id')->on('users');
            $table->foreign('user_selling_id')->references('id')->on('users');

            $table->foreign('currency_buying_id')->references('id')->on('currencies');
            $table->foreign('currency_selling_id')->references('id')->on('currencies');

            $table->foreign('exchange_id')->references('id')->on('exchanges');

            //$table->index(['exchange_id']);
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
        Schema::dropIfExists('exchange_order_completeds');
    }
}
