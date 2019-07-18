<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExchangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchanges', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');

            $table->uuid('currency_buying_id')->index();
            $table->uuid('currency_selling_id')->index();

            $table->uuid('currency_buying_name')->index();
            $table->uuid('currency_selling_name')->index();

            $table->uuid('currency_buying_short_name');
            $table->uuid('currency_selling_short_name');

            $table->uuid('currency_buying_long_name');
            $table->uuid('currency_selling_long_name');

            $table->string('currency_buying_icon');
            $table->string('currency_selling_icon');

            $table->unsignedDecimal('actual_price', 15, 8)->default(0);
            $table->unsignedDecimal('buy_price', 15, 8)->default(0);
            $table->unsignedDecimal('sell_price', 15, 8)->default(0);
            $table->unsignedDecimal('low_price', 15, 8)->default(0);
            $table->unsignedDecimal('high_price', 15, 8)->default(0);
            $table->unsignedDecimal('volume', 15, 8)->default(0);
            $table->Decimal('change_percent', 15, 8)->default(0);


            $table->unsignedDecimal('min_trade_amount', 15, 8)->default(0);
            $table->unsignedDecimal('min_trade_price', 15, 8)->default(0);



            $table->boolean('commission')->default(true)->index();
            $table->boolean('active')->default(false)->index();
            $table->unsignedTinyInteger('order')->unique();
            $table->timestamps();

            $table->foreign('currency_buying_id')->references('id')->on('currencies');
            $table->foreign('currency_selling_id')->references('id')->on('currencies');

            $table->foreign('currency_buying_name')->references('name')->on('currencies');
            $table->foreign('currency_selling_name')->references('name')->on('currencies');

            $table->foreign('currency_buying_icon')->references('icon')->on('currencies');
            $table->foreign('currency_selling_icon')->references('icon')->on('currencies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exchanges');
    }
}
