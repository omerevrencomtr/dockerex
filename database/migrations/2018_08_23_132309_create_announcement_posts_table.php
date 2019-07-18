<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnouncementPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcement_posts', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->unsignedInteger('order')->nullable()->unique();
            $table->uuid('announcement_category_id')->index();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('meta_key');
            $table->string('meta_description');
            $table->text('content');
            $table->string('icon');
            $table->boolean('active')->default(true)->index();
            $table->timestamps();


            $table->foreign('announcement_category_id')->references('id')->on('announcement_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('announcement_posts');
    }
}
