<?php
namespace Database\Seeders;

use App\Models\GeneralSetting;
use Illuminate\Database\Seeder;

class GeneralSettingSeeder extends Seeder
{
    public function run()
    {
        $generalSetting = new GeneralSetting();
        $generalSetting->site_logo         = 'logo.png';
        $generalSetting->showLogo_inSign = 'Yes';
        $generalSetting->showImage_Background  = 'Yes';
        $generalSetting->signIn_backgroundImage  = 'background.jpg';
        $generalSetting->app_title  = 'LaraStarter - Backend Panel';
        $generalSetting->language  = 'English';
        $generalSetting->timezone  = 'Asia/Kolkata';
        $generalSetting->dateFormat  = 'YYYY-MM-DD';
        $generalSetting->timeFormat  = 'capital';
        $generalSetting->currency  = 'INR';
        $generalSetting->currency_symbol  = 'Rs.';
        $generalSetting->currency_position  = 'left';
        $generalSetting->row_per_page  = '10';
        $generalSetting->save();
    }
}
