<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeys extends Migration {

    public function up()
    {
        Schema::table('states', function(Blueprint $table) {
            $table->foreign('country_id')->references('id')->on('countries')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
        Schema::table('social_links', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::table('states', function(Blueprint $table) {
            $table->dropForeign('states_country_id_foreign');
        });
        Schema::table('social_links', function(Blueprint $table) {
            $table->dropForeign('social_links_user_id_foreign');
        });
    }
}