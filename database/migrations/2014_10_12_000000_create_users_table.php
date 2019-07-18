<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');

            $table->string('name');
            $table->string('surname');

            $table->string('password');

            $table->string('email')->unique();

            $table->boolean('email_confirmed')->default(false);
            $table->boolean('email_login_active')->default(false);

            $table->string('phone', 15)->unique()->nullable();
            $table->boolean('phone_confirmed')->default(false);
            $table->boolean('phone_login_active')->default(false);


            $table->text('google2fa_secret')->nullable();
            $table->boolean('google2fa_login_active')->default(false);
            $table->string('google2fa_ts', 15)->nullable();
            $table->string('deposit_id', 8)->unique();
            $table->enum('login_default_type', ['email', 'phone','google2fa'])->default('phone')->nullable();

            $table->enum('confirmed_level', ['starter', 'approved','special','custom'])->default('starter');
            $table->unsignedDecimal('maker_commission', 15, 8)->nullable();
            $table->unsignedDecimal('taker_commission', 15, 8)->nullable();
            $table->boolean('confirmed')->default(false);

            $table->boolean('admin')->default(false);
            $table->enum('admin_level', ['founder', 'manager','operator','auditor'])->nullable();

            $table->char('language_code',2)->default('tr');

            $table->char('country_code',2)->default('tr');


            $table->boolean('active')->default(true);
            $table->rememberToken();
            $table->timestamps();



            $table->foreign('language_code')->references('iso')->on('languages');
            $table->foreign('country_code')->references('iso')->on('countries');
            //$table->foreign('phone_code')->references('phone_code')->on('countries');



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
        Schema::dropIfExists('users');
    }
}
