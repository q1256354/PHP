<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_list', function (Blueprint $table) {
            $table->increments('leave_num');
            $table->string('id', 100);
			$table->string('name', 100);
            $table->string('title', 100);
            $table->date('take_office');
            $table->string('reason', 100);
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->string('total', 100);
            $table->string('status', 100);
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
        Schema::dropIfExists('leave_list');
    }
}
