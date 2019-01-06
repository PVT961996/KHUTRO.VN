<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupMenusTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_menus', function (Blueprint $table) {
            $table->increments('id')->nullable();
            $table->integer('group_id')->nullable()->unsigned();
            $table->integer('menu_id')->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('group_id')->references('id')->on('groups');
            $table->foreign('menu_id')->references('id')->on('menus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('group_menus');
    }
}
