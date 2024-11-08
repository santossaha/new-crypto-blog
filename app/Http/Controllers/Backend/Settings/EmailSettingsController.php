<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Mail\TestMail;
use App\Models\EmailSetting;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class EmailSettingsController extends Controller
{
    public function index(){
        $data = EmailSetting::first();
        return view('Backend.Settings.Email.All',['ID'=>$data->id,'data'=>$data]);
    }

    public function saveEmailSetting(Request $request, $id){
        $this->validate($request, [
            'sent_email' => 'required',
            'sent_email_name' => 'required'
        ]);

        $sent_email = $request->get('sent_email');
        $sent_email_name = $request->get('sent_email_name');

        $smtp_host = $request->get('smtp_host');
        $smtp_user = $request->get('smtp_user');
        $smtp_password = $request->get('smtp_password');
        $smtp_port = $request->get('smtp_port');
        $security_type = $request->get('security_type');

        $send_test_email = $request->get('send_test_email');

        $update= EmailSetting::findOrFail($id);
        $update->sent_email = $sent_email;
        $update->sent_email_name = $sent_email_name;

        if($request->get('use_smtp') && $request->get('use_smtp')=='Yes'){
            $update->use_smtp = 'Yes';
            $update->smtp_host = $smtp_host;
            $update->smtp_user = $smtp_user;
            $update->smtp_password = $smtp_password;
            $update->smtp_port = $smtp_port;
            $update->security_type = $security_type;
        }else{
            $update->use_smtp = 'No';
        }
        $update->save();

        if($request->get('use_smtp') == "Yes"){
            $config = [
                'driver' => 'smtp',
                'host' => $smtp_host,
                'port' => $smtp_port,
                'from' => ['address' => $sent_email, 'name' => $sent_email_name],
                'encryption' => $security_type,
                'username' => $smtp_user,
                'password' => $smtp_password
            ];
            Config::set('mail', $config);
        } else {
            $config = [
                'driver' => 'sendmail',
                'from' => ['address' => $sent_email, 'name' => $sent_email_name],
                'sendmail' => '/usr/sbin/sendmail -bs'
            ];
            Config::set('mail', $config);
        }
        if($send_test_email != ""){
            $request_sent = array(
                'to' => $send_test_email
            );
            Mail::to($send_test_email)->send(new TestMail($request_sent));
        }
        Session::flash('success', "Email setting has been updated");
        return redirect()->back();

    }




}
