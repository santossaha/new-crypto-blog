<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxesSettingTable extends Migration {

	public function up()
	{
		Schema::create('taxes_setting', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 200);
			$table->decimal('tax', 65,2);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('taxes_setting');
	}
}