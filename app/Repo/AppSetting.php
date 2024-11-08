<?php
namespace App\Repo;

use App\Models\CompanySetting;
use App\Models\GeneralSetting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class AppSetting
{
    public static function getLogo(){
        if(Config::has('app.site_logo')){
            return url(asset('uploads/generalSetting/'.Config::get('app.site_logo')));
        }else{
            if(Schema::hasTable('general_setting')) {
                $generalSetting = GeneralSetting::select('site_logo')->first();
                return url(asset('uploads/generalSetting/'.$generalSetting->site_logo));
            }else{
                return false;
            }
        }
    }

    public static function getRowsPerPage(){
        if(Config::has('app.row_per_page')){
            return Config::get('app.row_per_page');
        }else {
            if (Schema::hasTable('general_setting')) {
                $generalSetting = GeneralSetting::select('row_per_page')->first();
                return $generalSetting->row_per_page;
            } else {
                return 10;
            }
        }
    }

    public static function getDateFormat(){
        if(Config::has('app.dateFormat')){
            return Config::get('app.dateFormat');
        }else{
            if(Schema::hasTable('general_setting')) {
                $generalSetting = GeneralSetting::select('dateFormat')->first();
                return $generalSetting->dateFormat;
            }else{
                return false;
            }
        }
    }

    public static function getCurrencyPosition(){
        if(Config::has('app.currency_position')){
            return Config::get('app.currency_position');
        }else {
            if (Schema::hasTable('general_setting')) {
                $generalSetting = GeneralSetting::select('currency_position')->first();
                return $generalSetting->currency_position;
            } else {
                return false;
            }
        }
    }

    public static function getCurrencySymbol(){
        if(Config::has('app.currency_symbol')){
            return Config::get('app.currency_symbol');
        }else {
            if (Schema::hasTable('general_setting')) {
                $generalSetting = GeneralSetting::select('currency_symbol')->first();
                return $generalSetting->currency_symbol;
            } else {
                return false;
            }
        }
    }

    public static function getTimezone(){
        if(Config::has('app.timezone')){
            return Config::get('app.timezone');
        }else {
            if (Schema::hasTable('general_setting')) {
                $generalSetting = GeneralSetting::select('timezone')->first();
                return $generalSetting->timezone;
            } else {
                return false;
            }
        }
    }

    public static function getDate($date){
        if(Config::has('app.dateFormat')){
            $dateFormat = Config::get('app.dateFormat');
        }else {
            if(Schema::hasTable('general_setting')) {
                $generalSetting = GeneralSetting::select('dateFormat')->first();
                $dateFormat = $generalSetting->dateFormat;
            }else{
                $dateFormat = false;
            }
        }
        if($dateFormat){
            if($dateFormat=='YYYY-MM-DD'){
                return date('Y-m-d',strtotime($date));
            }else if($dateFormat=='MM-DD-YYYY'){
                return date('m-d-Y',strtotime($date));
            }else if($dateFormat=='DD-MM-YYYY'){
                return date('d-m-Y',strtotime($date));
            }else if($dateFormat=='YYYY/MM/DD'){
                return date('Y/m/d',strtotime($date));
            }else if($dateFormat=='MM/DD/YYYY'){
                return date('m/d/Y',strtotime($date));
            }else if($dateFormat=='DD/MM/YYYY'){
                return date('d/m/Y',strtotime($date));
            }else if($dateFormat=='YYYY-MMM-DD'){
                return date('Y-M-d',strtotime($date));
            }else if($dateFormat=='MMM-DD-YYYY'){
                return date('M-d-Y',strtotime($date));
            }else if($dateFormat=='DD-MMM-YYYY'){
                return date('d-M-Y',strtotime($date));
            }else if($dateFormat=='YYYY/MMM/DD'){
                return date('Y/M/d',strtotime($date));
            }else if($dateFormat=='MMM/DD/YYYY'){
                return date('M/d/Y',strtotime($date));
            }else if($dateFormat=='DD/MMM/YYYY'){
                return date('d/M/Y',strtotime($date));
            }else {
                return false;
            }
        }else{
            return false;
        }
    }

    public static function getTime($time){
        if(Config::has('app.timeFormat')){
            $timeFormat = Config::get('app.timeFormat');
        }else {
            if(Schema::hasTable('general_setting')) {
                $generalSetting = GeneralSetting::select('timeFormat')->first();
                $timeFormat = $generalSetting->timeFormat;
            }else{
                $timeFormat = false;
            }
        }
        if($timeFormat){
            if($timeFormat=='capital'){
                return date('h:i A',strtotime($time));
            }else if($timeFormat=='small'){
                return date('h:i a',strtotime($time));
            }else if($timeFormat=='24_hours'){
                return date('H:i',strtotime($time));
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public static function getCurrency($amount){
        if(Config::has('app.currency_position')){
            $currency_position = Config::get('app.currency_position');
        }else {
            if(Schema::hasTable('general_setting')) {
                $generalSetting = GeneralSetting::select('currency_symbol', 'currency_position')->first();
                $currency_position = $generalSetting->currency_position;
            }else{
                $currency_position = false;
            }
        }
        if($currency_position){
            if($currency_position=='left'){
                return self::getCurrencySymbol().$amount;
            }else if($currency_position=='right'){
                return $amount.' '.self::getCurrencySymbol();
            }else{
                return false;
            }
        }else{
            return false;
        }
    }



    public static function SidebarMenuCollapse(){
        $status = false;
        $menus = [];
        foreach ($menus as $menu){
            if(strpos(url()->current(),$menu)){
                $status = true;
            }
        }
        return $status;
    }
}
