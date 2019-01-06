<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRoomsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id')->nullable();
            $table->text('name',255);
            $table->integer('motel_id')->nullable()->unsigned();
            $table->text('area',255)->nullable();
            $table->integer('number_people')->nullable()->unsigned();
            $table->text('price',255)->nullable();
            $table->text('status',255)->nullable();
            $table->text('toilet')->nullable();
            $table->text('description')->nullable();
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
        Schema::drop('rooms');
    }
}
