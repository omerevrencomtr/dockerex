<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrencyTransferCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currency_transfer_commissions', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->uuid('currency_id')->index();
            $table->enum('key', ['normal', 'fast'])->index();
            $table->enum('direction', ['withdraw','deposit'])->index();
            $table->unsignedDecimal('amount', 15, 8);
            $table->timestamps();

            $table->foreign('currency_id')->references('id')->on('currencies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currency_withdraw_commissions');
    }
}
