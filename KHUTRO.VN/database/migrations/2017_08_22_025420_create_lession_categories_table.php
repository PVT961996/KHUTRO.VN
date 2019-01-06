<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLessionCategoriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lession_categories', function (Blueprint $table) {
            $table->increments('id')->nullable();
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('parent_id')->nullable()->unsigned();
            $table->string('slug')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('parent_id')->references('id')->on('lession_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lession_categories');
    }
}
