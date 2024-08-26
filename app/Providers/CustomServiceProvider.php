<?php

namespace App\Providers;

use App;
use App\Models\EmailSetting;
use App\Models\GeneralSetting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use \Illuminate\Support\Facades\Schema;

class CustomServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(){

        try {
            if(Schema::hasTable('email_setting')) {
                $mail = EmailSetting::first();
                if(isset($mail->id)) {
                    $use_smtp = $mail->use_smtp;
                    if($use_smtp == "Yes"){
                        $config = [
                            'driver' => 'smtp',
                            'host' => $mail->smtp_host,
                            'port' => $mail->smtp_port,
                            'from' => ['address' => $mail->sent_email, 'name' => $mail->sent_email_name],
                            'encryption' => $mail->security_type,
                            'username' => $mail->smtp_user,
                            'password' => $mail->smtp_password
                        ];
                        Config::set('mail', $config);
                    } else {
                        $config = [
                            'driver' => 'sendmail',
                            'from' => ['address' => $mail->sent_email, 'name' => $mail->sent_email_name],
                            'sendmail' => '/usr/sbin/sendmail -bs'
                        ];
                        Config::set('mail', $config);
                    }
                }
            }


            //$app = App::getInstance();
            //$app->register('Illuminate\Mail\MailServiceProvider');

            if(Schema::hasTable('general_setting')) {
                $generalSetting = GeneralSetting::first();
                if(isset($generalSetting->id)) {
                    Config::set(['app.timezone' => $generalSetting->timezone]);
                    date_default_timezone_set($generalSetting->timezone);
                    if(isset($generalSetting->site_logo)){
                        Config::set('app.site_logo', $generalSetting->site_logo);
                    }
                    if(isset($generalSetting->app_title)){
                        Config::set('app.name', $generalSetting->app_title);
                    }
                    if(isset($generalSetting->language)){
                        Config::set('app.language', $generalSetting->language);
                    }
                    if(isset($generalSetting->dateFormat)){
                        Config::set('app.dateFormat', $generalSetting->dateFormat);
                    }
                    if(isset($generalSetting->timeFormat)){
                        Config::set('app.timeFormat', $generalSetting->timeFormat);
                    }
                    if(isset($generalSetting->currency)){
                        Config::set('app.currency',$generalSetting->currency);
                    }
                    if(isset($generalSetting->currency_symbol)){
                        Config::set('app.currency_symbol',$generalSetting->currency_symbol);
                    }
                    if(isset($generalSetting->currency_position)){
                        Config::set('app.currency_position',$generalSetting->currency_position);
                    }
                    if(isset($generalSetting->row_per_page)){
                        Config::set('app.row_per_page',$generalSetting->row_per_page);
                    }
                }
            }

        }catch (\Exception $e) {

        }

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }
}
