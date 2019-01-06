<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeviceMotelsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sevice_motels', function (Blueprint $table) {
            $table->increments('id')->nullable();
            $table->integer('sevice_id')->nullable()->unsigned();
            $table->integer('motel_id')->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('sevice_id')->references('id')->on('sevices');
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
        Schema::drop('sevice_motels');
    }
}
