<?php
namespace Database\Seeders;

use App\Models\EmailSetting;
use Illuminate\Database\Seeder;

class EmailSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new EmailSetting();
        $data->sent_email  = 'test@gmail.com';
        $data->sent_email_name  = 'John Doe';
        $data->use_smtp  = 'No';
        $data->smtp_host  = '';
        $data->smtp_user  = '';
        $data->smtp_password  = '';
        $data->smtp_port  = '';
        $data->security_type  = '';
        $data->save();
    }
}
