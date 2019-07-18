<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->uuid('user_id')->index();
            $table->string('topic');
            $table->boolean('status')->default(true)->index();
            $table->boolean('user_read')->default(true)->index();
            $table->boolean('admin_read')->default(false)->index();
            $table->boolean('active')->default(true)->index();
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
        Schema::dropIfExists('tickets');
    }
}
