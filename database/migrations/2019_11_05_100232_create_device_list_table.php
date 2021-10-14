<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeviceListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_list', function (Blueprint $table) {
            $table->increments('num');
			$table->string('item', 100);
			$table->string('label', 100);
			$table->string('model', 100);
			$table->string('quantity', 100)->nullable();
			$table->date('insert_date')->nullable();
			$table->string('staff', 100)->nullable();
			$table->string('purpose', 100)->nullable();
			$table->string('location', 100)->nullable();
			$table->string('status', 10)->nullable();
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
        Schema::dropIfExists('device_list');
    }
}
