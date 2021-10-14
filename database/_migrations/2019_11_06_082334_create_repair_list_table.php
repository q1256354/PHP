<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepairListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repair_list', function (Blueprint $table) {
            $table->increments('num');
			$table->string('item', 100)->nullable();
            $table->string('reason', 100)->nullable();
            $table->string('status', 100)->nullable();
            $table->string('applicant', 100)->nullable();
			$table->string('remarks', 100)->nullable();
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
        Schema::dropIfExists('repair_list');
    }
}
