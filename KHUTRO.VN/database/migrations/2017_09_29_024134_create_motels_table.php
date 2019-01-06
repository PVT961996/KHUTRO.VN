<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMotelsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motels', function (Blueprint $table) {
            $table->increments('id')->nullable();
            $table->text('title',255);
            $table->string('slug');
            $table->integer('user_id')->nullable()->unsigned();
            $table->integer('motel_category_id')->nullable()->unsigned();
            $table->double('min_price')->nullable();
            $table->double('max_price')->nullable();
            $table->integer('area')->nullable();
            $table->text('address',255);
            $table->integer('province_id')->nullable()->unsigned();
            $table->integer('district_id')->nullable()->unsigned();
            $table->integer('town_id')->nullable()->unsigned();
            $table->integer('street_id')->nullable()->unsigned();
            $table->integer('views')->nullable();
            $table->timestamp('due_date')->nullable();
            $table->text('short_description')->nullable();
            $table->integer('featured')->nullable();
            $table->integer('status')->nullable();
            $table->text('image_title',255);
            $table->integer('config_price_id')->nullable()->unsigned();
            $table->text('deposits',255);
            $table->integer('original_id')->nullable()->unsigned();
            $table->text('seo_title',255)->nullable();
            $table->text('seo_tag',50)->nullable();
            $table->text('seo_description',500)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('motel_category_id')->references('id')->on('motel_categories');
            $table->foreign('province_id')->references('id')->on('provinces');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('town_id')->references('id')->on('towns');
            $table->foreign('street_id')->references('id')->on('streets');
            $table->foreign('config_price_id')->references('id')->on('config_prices');
            $table->foreign('original_id')->references('id')->on('motels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('motels');
    }
}
