<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFeedbackProfilesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback_profiles', function (Blueprint $table) {
            $table->increments('id')->nullable();
            $table->integer('user_id')->nullable()->unsigned();
            $table->integer('profile_id')->nullable()->unsigned();
            $table->integer('parent_id')->nullable()->unsigned();
            $table->string('content')->nullable();
            $table->integer('rate_score')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('profile_id')->references('id')->on('profiles');
            $table->foreign('parent_id')->references('id')->on('feedback_profiles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('feedback_profiles');
    }
}
