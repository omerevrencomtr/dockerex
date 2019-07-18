<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnouncementCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcement_categories', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->unsignedInteger('order')->nullable()->unique();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('meta_key');
            $table->string('meta_description');
            $table->string('icon');
            $table->boolean('active')->index()->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('announcement_categories');
    }
}
