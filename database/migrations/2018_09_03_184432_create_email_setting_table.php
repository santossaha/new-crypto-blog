<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailSettingTable extends Migration {

	public function up()
	{
		Schema::create('email_setting', function(Blueprint $table) {
			$table->increments('id');
			$table->string('sent_email');
			$table->string('sent_email_name');
			$table->enum('use_smtp', array('No', 'Yes'));
			$table->string('smtp_host')->nullable();
			$table->string('smtp_user')->nullable();
			$table->string('smtp_password')->nullable();
			$table->string('smtp_port', 10)->nullable();
			$table->enum('security_type', array('', 'TLS', 'SSL'))->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('email_setting');
	}
}