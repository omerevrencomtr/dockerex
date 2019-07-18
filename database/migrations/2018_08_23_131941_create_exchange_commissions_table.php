<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExchangeCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchange_commissions', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->uuid('exchange_id')->index();
            $table->unsignedDecimal('min', 15, 8)->index();
            $table->unsignedDecimal('max', 15, 8);
            $table->unsignedDecimal('maker', 15, 8);
            $table->unsignedDecimal('taker', 15, 8);
            $table->timestamps();

            $table->foreign('exchange_id')->references('id')->on('exchanges');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exchange_commissions');
    }
}
