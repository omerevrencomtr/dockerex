<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCurrencyTransferOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_currency_transfer_orders', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->uuid('user_id')->index();
            $table->uuid('currency_id')->index();
            $table->uuid('admin_id')->nullable();
            $table->boolean('crypto')->index();
            $table->enum('direction', ['withdraw','deposit'])->index();
            $table->enum('status', ['waiting','processed'])->default('waiting');
            $table->string('address');
            $table->string('transfer_code')->nullable();
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
        Schema::dropIfExists('user_currency_deposit_orders');
    }
}
