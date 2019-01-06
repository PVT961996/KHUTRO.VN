<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('age')->nullable();
            $table->integer('sex')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('card_id')->nullable();
            $table->string('issued_card')->nullable();
            $table->string('job')->nullable();
            $table->string('description')->nullable();
            $table->string('slug');

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
