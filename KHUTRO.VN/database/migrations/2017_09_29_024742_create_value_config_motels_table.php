<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateValueConfigMotelsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('value_config_motels', function (Blueprint $table) {
            $table->increments('id')->nullable();
            $table->integer('config_category_id')->nullable()->unsigned();
            $table->text('value')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('config_category_id')->references('id')->on('config_motel_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('value_config_motels');
    }
}
