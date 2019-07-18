<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->unsignedInteger('order');
            $table->uuid('blog_category_id')->index();
            $table->string('image')->nullable();
            $table->string('url')->nullable();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('meta_key');
            $table->string('meta_description');
            $table->text('content');
            $table->string('icon');
            $table->boolean('active')->default(true)->index();
            $table->timestamps();

            $table->foreign('blog_category_id')->references('id')->on('blog_categories');

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
        Schema::dropIfExists('blog_posts');
    }
}
