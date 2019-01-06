<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoryPostsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_posts', function (Blueprint $table) {
            $table->increments('id')->nullable();
            $table->integer('post_category_id')->nullable()->unsigned();
            $table->integer('post_id')->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('post_category_id')->references('id')->on('post_categories');
            $table->foreign('post_id')->references('id')->on('posts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('category_posts');
    }
}
