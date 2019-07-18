<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrencyTransferAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currency_transfer_addresses', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->uuid('currency_id')->index();
            $table->uuid('user_id')->nullable()->index();
            $table->string('address')->unique();
            $table->string('name')->nullable();
            $table->unsignedInteger('order')->nullable();
            $table->boolean('used')->default(false)->index();
            $table->boolean('active')->default(false)->index();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('currency_id')->references('id')->on('currencies');

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
        Schema::dropIfExists('currency_crypto_addresses');
    }
}
