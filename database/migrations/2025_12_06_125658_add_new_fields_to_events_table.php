<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddNewFieldsToEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            // Add new fields
            if (!Schema::hasColumn('events', 'content')) {
                $table->text('content')->nullable()->after('title');
            }
            if (!Schema::hasColumn('events', 'from_date')) {
                $table->date('from_date')->nullable()->after('slug');
            }
            if (!Schema::hasColumn('events', 'to_date')) {
                $table->date('to_date')->nullable()->after('from_date');
            }
            if (!Schema::hasColumn('events', 'start_time')) {
                $table->time('start_time')->nullable()->after('to_date');
            }
            if (!Schema::hasColumn('events', 'to_time')) {
                $table->time('to_time')->nullable()->after('start_time');
            }
            if (!Schema::hasColumn('events', 'contact_detail')) {
                $table->string('contact_detail')->nullable()->after('location');
            }
            if (!Schema::hasColumn('events', 'email')) {
                $table->string('email')->nullable()->after('contact_detail');
            }
            if (!Schema::hasColumn('events', 'website_url')) {
                $table->string('website_url')->nullable()->after('email');
            }
            if (!Schema::hasColumn('events', 'facebook')) {
                $table->string('facebook')->nullable()->after('website_url');
            }
            if (!Schema::hasColumn('events', 'instagram')) {
                $table->string('instagram')->nullable()->after('facebook');
            }
            if (!Schema::hasColumn('events', 'linkedin')) {
                $table->string('linkedin')->nullable()->after('instagram');
            }
        });

        // Copy data from start_date/end_date to from_date/to_date if columns exist
        if (Schema::hasColumn('events', 'start_date') && Schema::hasColumn('events', 'from_date')) {
            DB::statement('UPDATE events SET from_date = start_date WHERE from_date IS NULL');
        }
        if (Schema::hasColumn('events', 'end_date') && Schema::hasColumn('events', 'to_date')) {
            DB::statement('UPDATE events SET to_date = end_date WHERE to_date IS NULL');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            // Drop new columns
            $columns = ['content', 'from_date', 'to_date', 'start_time', 'to_time', 'contact_detail', 'email', 'website_url', 'facebook', 'instagram', 'linkedin'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('events', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
}
