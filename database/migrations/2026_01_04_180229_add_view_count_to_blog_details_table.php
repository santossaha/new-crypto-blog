<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddViewCountToBlogDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blog_details', function (Blueprint $table) {
            $table->unsignedInteger('view_count')->default(0)->after('canonical');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog_details', function (Blueprint $table) {
            $table->dropColumn('view_count');
        });
    }
}
