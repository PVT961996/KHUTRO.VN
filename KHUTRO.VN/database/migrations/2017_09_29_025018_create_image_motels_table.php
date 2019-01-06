<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImageMotelsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_motels', function (Blueprint $table) {
            $table->increments('id')->nullable();
            $table->string('image',255)->nullable();
            $table->integer('motel_id')->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('motel_id')->references('id')->on('motels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('image_motels');
    }
}
