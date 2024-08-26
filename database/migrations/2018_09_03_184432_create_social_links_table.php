<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialLinksTable extends Migration {

	public function up()
	{
		Schema::create('social_links', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index();
			$table->string('facebook')->nullable();
			$table->string('google_plus')->nullable();
			$table->string('twitter')->nullable();
			$table->string('linkedin')->nullable();
			$table->string('youtube')->nullable();
			$table->string('instagram')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('social_links');
	}
}