<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMotelIdToValueConfigMotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('value_config_motels', function (Blueprint $table) {
            $table->integer('motel_id')->nullable()->unsigned();
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
        Schema::table('value_config_motels', function (Blueprint $table) {
            //
        });
    }
}
