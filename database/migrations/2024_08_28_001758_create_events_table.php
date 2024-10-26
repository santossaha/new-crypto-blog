<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();

            $table->string('title');
            $table->string('slug');
            $table->string('location');
            $table->string('image');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status',['Active','Inactive'])->default('Active');
            $table->string('meta_keyword');
            $table->string('meta_title');
            $table->string('meta_description');
            $table->string('author')->nullable();
            $table->string('canonical')->nullable();
            $table->timestamps();


            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('restrict')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
