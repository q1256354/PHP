<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('level', 255)->nullable();
            $table->string('first_name', 255);
            $table->string('last_name', 255);
            $table->string('phone', 255)->nullable();
            $table->string('birthday', 255)->nullable();
            $table->string('department', 255)->nullable();
            $table->string('title', 255)->nullable();
            $table->string('account', 255)->nullable();
            $table->string('nickname', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('password', 255);
            $table->string('start_office_date',100)->nullable();
            $table->string('remember_token',100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
