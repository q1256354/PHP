<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipmentListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_list', function (Blueprint $table) {
            $table->increments('num');
			$table->string('shipment_num', 100)->nullable();
			$table->string('company', 100)->nullable();
			$table->string('case_num', 100)->nullable();
			$table->string('contact', 100)->nullable();
			$table->string('address',100)->nullable();
			$table->string('item', 100)->nullable();
			$table->string('quantity', 100)->nullable();
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
        Schema::dropIfExists('shipment_list');
    }
}
