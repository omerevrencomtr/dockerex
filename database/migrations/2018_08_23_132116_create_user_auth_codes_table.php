<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAuthCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_auth_codes', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->uuid('user_id')->index();
            $table->text('key_secret');
            $table->string('phone', 15);
            $table->string('email');
            $table->boolean('used')->default(false);
            $table->enum('type', ['register_email','register_sms','register_call','login_sms', 'login_email','login_call','withdraw_sms', 'withdraw_call','withdraw_email']);
            $table->timestamps();

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
        Schema::dropIfExists('user_auth_codes');
    }
}
