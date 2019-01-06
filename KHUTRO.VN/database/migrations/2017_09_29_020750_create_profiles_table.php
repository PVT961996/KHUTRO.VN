<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProfilesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id')->nullable();
            $table->text('title',255);
            $table->integer('user_id')->nullable()->unsigned();
            $table->integer('motel_category_id')->nullable()->unsigned();
            $table->text('short_description')->nullable();
            $table->text('image_title',255)->nullable();
            $table->text('address',255)->nullable();
            $table->integer('area')->nullable();
            $table->integer('province_id')->nullable()->unsigned();
            $table->integer('district_id')->nullable()->unsigned();
            $table->integer('town_id')->nullable()->unsigned();
            $table->timestamp('due_date')->nullable();
            $table->text('content')->nullable();
            $table->text('seo_title',255)->nullable();
            $table->text('seo_tag',50)->nullable();
            $table->text('seo_description',500)->nullable();
            $table->string('slug');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('motel_category_id')->references('id')->on('motel_categories');
            $table->foreign('province_id')->references('id')->on('provinces');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('town_id')->references('id')->on('towns');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('profiles');
    }
}
