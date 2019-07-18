<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->string('name')->unique();
            $table->boolean('crypto');
            $table->string('short_name')->unique();
            $table->string('long_name')->unique();
            $table->unsignedTinyInteger('decimal');
            $table->unsignedTinyInteger('order')->unique();
            $table->string('color_code')->nullable();
            $table->string('logo')->nullable();
            $table->string('icon')->unique();
            $table->string('tx_url')->nullable();
            $table->string('address_url')->nullable();
            $table->string('withdraw_description')->nullable();
            $table->string('deposit_description')->nullable();
            $table->unsignedTinyInteger('approval_number')->nullable();
            $table->unsignedDecimal('exchange_min', 15, 8);
            $table->unsignedDecimal('exchange_max', 15, 8);
            $table->unsignedDecimal('deposit_min', 15, 8);
            $table->unsignedDecimal('deposit_max', 15, 8);
            $table->unsignedDecimal('withdraw_min', 15, 8);
            $table->unsignedDecimal('withdraw_max', 15, 8);
            $table->boolean('active')->default(false);
            $table->boolean('exchange')->default(false);
            $table->boolean('deposit')->default(false);
            $table->boolean('withdraw')->default(false);
            $table->timestamps();

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
        Schema::dropIfExists('currencies');
    }
}
