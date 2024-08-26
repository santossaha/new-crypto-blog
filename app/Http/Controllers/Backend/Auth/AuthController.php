<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Mail\ForgotPassword;
use App\Models\CompanySetting;
use App\Models\GeneralSetting;
use App\Models\User;
use Zizaco\Entrust\EntrustFacade as Entrust;
use Exception;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth as eAuth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    public function forgot(){
        if(eAuth::check()){
            return redirect()->route('dashboard');
        }
        $GeneralSetting = GeneralSetting::first();
        return view('Backend.forgot',['data'=>$GeneralSetting]);
    }

    public function forgot_post(Request $request){
        $this->validate($request, [
            'email' => 'required|email|exists:users,email'
        ]);
        $email = $request->get('email');
        $user_details = User::select('id','name','email')->where('email',$email)->first();
        $request_sent = array(
            'id' => $user_details->id,
            'name' => $user_details->name,
            'email' => $user_details->email,
        );
        $status = Mail::to($email)->send(new ForgotPassword($request_sent));
        Session::flash('success', "we have send the reset password link to your register email address");
        return redirect()->back();
    }

    public function resetPassword($id){
        try {
            $userId = decrypt($id);
            $GeneralSetting = GeneralSetting::first();
            return view('Backend.changePassword',['data'=>$GeneralSetting,'ID'=>$id]);
        } catch (DecryptException $e) {
            Session::flash('error', "invalid Url Link");
            return redirect()->route('forgot');
        }
    }

    public function saveResetPassword(Request $request, $id){
        try {
            $userId = decrypt($id);
            $userDetails = User::find($userId);
            $this->validate($request, [
                'new_password' => 'required',
                'retype_new_password' => 'required|same:new_password',
            ]);

            $password = $request->get('retype_new_password');
            $userDetails->password = bcrypt($password);
            $userDetails->save();
            Session::flash('success', "Password has been updated");
            return redirect()->route('login');

        } catch (DecryptException $e) {
            Session::flash('error', "invalid Url Link");
            return redirect()->route('forgot');
        }
    }


    public function login(){
        if(eAuth::check()){
            return redirect()->route('dashboard');
        }
        $GeneralSetting = GeneralSetting::first();
        return view('Backend.login',['data'=>$GeneralSetting]);
    }

    public function login_validate(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (eAuth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
            if ($request->has('next')) {
                return redirect($request->get('next'));
            }else{
                return redirect()->route('dashboard');
            }
        }
        return redirect()->back()->withErrors(Lang::get('auth.failed'));
    }

    public function logout(){
        if(eAuth::check()) {
            eAuth::logout();
            return redirect()->route('login');
        }else{
            return redirect()->route('login');
        }
    }

    public function locked(){
        if(eAuth::check()) {
            Session::put('UserName', eAuth::user()->name);
            Session::put('UserEmail',eAuth::user()->email);
            Session::put('UserImage',eAuth::user()->profile_photo['name']);

            eAuth::logout();

            $GeneralSetting = GeneralSetting::first();
            $CompanySetting = CompanySetting::select('company_name')->first();
            return view('Backend.locked',['data'=>$GeneralSetting,'CompanyDetails'=>$CompanySetting]);

        }else if(Session::has('UserName') && Session::has('UserEmail') && Session::has('UserImage')){

            $GeneralSetting = GeneralSetting::first();
            $CompanySetting = CompanySetting::select('company_name')->first();
            return view('Backend.locked',['data'=>$GeneralSetting,'CompanyDetails'=>$CompanySetting]);

        }else{
            return redirect()->route('login');
        }
    }


    public function lockedOut(Request $request){
        $this->validate($request, [
            'password' => 'required',
        ]);
        if(Session::has('UserEmail')){
            if (eAuth::attempt(['email' => Session::get('UserEmail'), 'password' => $request->get('password')])) {
                if ($request->has('next')) {
                    return redirect($request->get('next'));
                }else{
                    return redirect()->route('dashboard');
                }
            }
            return redirect()->back()->withErrors(Lang::get('auth.failed'));
        }else{
            return redirect()->route('login');
        }
    }

    public function lockedLogout(){

        if(Session::has('UserName')){
            Session::remove('UserName');
        }
        if(Session::has('UserEmail')){
            Session::remove('UserEmail');
        }
        if(Session::has('UserImage')){
            Session::remove('UserImage');
        }
        return redirect()->route('login');
    }

}
