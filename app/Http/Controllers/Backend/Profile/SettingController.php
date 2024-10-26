<?php

namespace App\Http\Controllers\Backend\Profile;

use App\Models\SocialLinks;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    public function index(){
        $userId = Auth::user()->id;
        $data = SocialLinks::select('*')->where('user_id',$userId)->first();
        return view('Backend.Profile.account',['SocialLinks'=>$data]);
    }

    public function save(Request $request)
    {
        $userId = Auth::user()->id;
        $user = User::findOrFail($userId);
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password'
        ]);

        $old_password = $request->get('old_password');
        $new_password = $request->get('new_password');
        $confirm_password = $request->get('confirm_password');

        if (Hash::check($old_password, $user->password)) {
            $user->password = bcrypt($confirm_password);
            $user->save();
            Session::flash('success', "Password has been updated");
        }else{
            Session::flash('error', "Old Password Does Not Matched");
        }
        return redirect()->back();
    }
}
