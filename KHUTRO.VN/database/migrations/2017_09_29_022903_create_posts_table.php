<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id')->nullable();
            $table->text('title',255);
            $table->integer('user_id')->nullable()->unsigned();
            $table->text('short_description')->nullable();
            $table->text('content')->nullable();
            $table->text('image_title',255)->nullable();
            $table->text('seo_title',255)->nullable();
            $table->text('seo_tag',50)->nullable();
            $table->text('seo_description',500)->nullable();
            $table->string('slug');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posts');
    }
}
