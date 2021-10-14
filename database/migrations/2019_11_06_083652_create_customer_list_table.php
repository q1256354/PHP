<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_list', function (Blueprint $table) {
            $table->increments('num');
            $table->string('name', 100)->nullable();
			$table->string('first_name', 100)->nullable();
			$table->string('last_name', 100)->nullable();
			$table->string('company_name', 100)->nullable();
			$table->string('company_name_eng', 100)->nullable();
			$table->string('title',100)->nullable();
			$table->string('department', 100)->nullable();
			$table->string('address', 100)->nullable();
            $table->string('phone', 100)->nullable();
            $table->string('fax', 100)->nullable();
            $table->string('cellphone', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('url', 512)->nullable();
            $table->string('type', 100)->nullable();
            $table->string('tax_number', 100)->nullable();
            $table->string('repeat_status', 100)->nullable();
            $table->string('name_eng', 100)->nullable();
            $table->string('title_eng', 100)->nullable();
            $table->string('department_eng', 100)->nullable();
            $table->string('address_eng', 100)->nullable();
            $table->string('remark', 100)->nullable();
            $table->string('kind', 100)->nullable();
            $table->string('queue', 100)->nullable();
            $table->string('specialization', 100)->nullable();
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
        Schema::dropIfExists('customer_list');
    }
}
