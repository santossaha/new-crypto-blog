<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSocialMediaFieldsToCompanySettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_setting', function (Blueprint $table) {
            $table->string('facebook')->nullable()->after('gst_vat_number');
            $table->string('instagram')->nullable()->after('facebook');
            $table->string('youtube')->nullable()->after('instagram');
            $table->string('linkedin')->nullable()->after('youtube');
            $table->string('x')->nullable()->after('linkedin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_setting', function (Blueprint $table) {
            $table->dropColumn(['facebook', 'instagram', 'youtube', 'linkedin', 'x']);
        });
    }
}
