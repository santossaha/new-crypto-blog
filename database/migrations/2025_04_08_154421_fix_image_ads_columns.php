<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class FixImageAdsColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('image_ads', function (Blueprint $table) {
            // Safely add ads_image column if it doesn't exist
            if (!Schema::hasColumn('image_ads', 'ads_image')) {
                $table->string('ads_image')->nullable()->after('image');
            }

            // Safely add start_date column if it doesn't exist
            if (!Schema::hasColumn('image_ads', 'start_date')) {
                $table->date('start_date')->nullable()->after('ads_image');
            }

            // Safely add end_date column if it doesn't exist
            if (!Schema::hasColumn('image_ads', 'end_date')) {
                $table->date('end_date')->nullable()->after('start_date');
            }
        });

        // Copy data from expire_date to end_date if both columns exist
        if (Schema::hasColumn('image_ads', 'expire_date') && Schema::hasColumn('image_ads', 'end_date')) {
            DB::statement('UPDATE image_ads SET end_date = expire_date WHERE end_date IS NULL AND expire_date IS NOT NULL');

            // Check if expire_date column exists before dropping it
            if (Schema::hasColumn('image_ads', 'expire_date')) {
                Schema::table('image_ads', function (Blueprint $table) {
                    $table->dropColumn('expire_date');
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // No need to reverse anything as this is a corrective migration
    }
}
