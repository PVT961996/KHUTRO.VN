<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDeviceMotelsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_motels', function (Blueprint $table) {
            $table->increments('id')->nullable();
            $table->integer('device_id')->nullable()->unsigned();
            $table->integer('motel_id')->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('device_id')->references('id')->on('devices');
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
        Schema::drop('device_motels');
    }
}
