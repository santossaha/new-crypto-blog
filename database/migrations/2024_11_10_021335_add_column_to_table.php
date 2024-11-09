<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            // Check if 'description' column doesn't exist, then add it
            if (!Schema::hasColumn('events', 'description')) {
                $table->longText('description')->nullable(false);
            }

            // Check if 'status' column doesn't exist, then add it
            if (!Schema::hasColumn('events', 'status')) {
                $table->enum('status', ['Pending', 'Approved'])->default('Approved');
            }
        });
    }

    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            // Drop columns if they exist
            if (Schema::hasColumn('events', 'description')) {
                $table->dropColumn('description');
            }

            if (Schema::hasColumn('events', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
}
