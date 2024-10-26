<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadsTable extends Migration
{
    public function up()
    {
        Schema::create('uploads', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->string('table_name');
            $table->integer('table_id');
            $table->string('original_name');
            $table->string('uploaded_name');
            $table->string('uploaded_path');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('uploads');
    }
}
