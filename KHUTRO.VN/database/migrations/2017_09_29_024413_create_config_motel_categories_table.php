<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConfigMotelCategoriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_motel_categories', function (Blueprint $table) {
            $table->increments('id')->nullable();
            $table->text('field_name',255);
            $table->integer('motel_category_id')->nullable()->unsigned();
            $table->text('description')->nullable();
            $table->text('html_type',255)->nullable();
            $table->text('db_type',255)->nullable();
            $table->text('default_value')->nullable();
            $table->text('location',255)->nullable();
            $table->text('icon',255)->nullable();
            $table->text('image',255)->nullable();
            $table->text('class_css',255)->nullable();
            $table->integer('order');
            $table->string('slug');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('motel_category_id')->references('id')->on('motel_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('config_motel_categories');
    }
}
