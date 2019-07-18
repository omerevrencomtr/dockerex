<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCurrencyTransferOrderCompletedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_currency_transfer_completeds', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->uuid('user_id')->index();
            $table->uuid('currency_id')->index();
            $table->uuid('admin_id')->nullable();
            $table->uuid('currency_transfer_id')->index();
            $table->enum('direction', ['withdraw','deposit'])->index();
            $table->enum('status', ['canceled_customer', 'canceled_admin','completed']);
            $table->string('address');
            $table->string('transfer_code');
            $table->unsignedDecimal('amount', 15, 8);
            $table->unsignedDecimal('commission', 15, 8);
            $table->string('description')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('admin_id')->references('id')->on('users');
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
        Schema::dropIfExists('user_currency_withdraw_orders');
    }
}
