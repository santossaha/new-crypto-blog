<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanySettingTable extends Migration {

	public function up()
	{
		Schema::create('company_setting', function(Blueprint $table) {
			$table->increments('id');
			$table->string('company_name');
			$table->text('address');
			$table->string('city');
			$table->string('state');
			$table->string('country');
			$table->string('phone', 30);
			$table->string('email');
			$table->string('website');
			$table->string('gst_vat_number');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('company_setting');
	}
}