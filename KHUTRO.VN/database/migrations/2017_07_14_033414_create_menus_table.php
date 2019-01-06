<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenusTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id')->nullable();
            $table->integer('action_id')->nullable()->unsigned();
            $table->integer('table_id')->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('action_id')->references('id')->on('actions');
            $table->foreign('table_id')->references('id')->on('tables');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('menus');
    }
}
