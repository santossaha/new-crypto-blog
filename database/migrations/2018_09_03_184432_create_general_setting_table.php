<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralSettingTable extends Migration {

	public function up()
	{
		Schema::create('general_setting', function(Blueprint $table) {
			$table->increments('id');
			$table->string('site_logo', 100)->default('logo.png');
			$table->enum('showLogo_inSign', array('Yes', 'No'));
			$table->enum('showImage_Background', array('Yes', 'No'));
			$table->string('signIn_backgroundImage', 100)->default('background.jpg');
			$table->string('app_title')->default('Backend Panel');
			$table->string('language', 100)->default('English');
			$table->string('timezone', 100)->default('Asia/Kolkata');
			$table->enum('dateFormat', array('YYYY-MM-DD','MM-DD-YYYY','DD-MM-YYYY','YYYY/MM/DD','MM/DD/YYYY','DD/MM/YYYY','YYYY-MMM-DD','MMM-DD-YYYY','DD-MMM-YYYY','YYYY/MMM/DD','MMM/DD/YYYY','DD/MMM/YYYY'));
			$table->enum('timeFormat', array('capital', 'small', '24_hours'));
			$table->string('currency', 100)->default('INR');
			$table->string('currency_symbol', 100)->default('Rs.');
			$table->enum('currency_position', array('left', 'right'));
			$table->integer('row_per_page')->default('10');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('general_setting');
	}
}