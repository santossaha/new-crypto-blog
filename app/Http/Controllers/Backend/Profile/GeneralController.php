<?php

namespace App\Http\Controllers\Backend\Profile;

use App\Models\SocialLinks;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class GeneralController extends Controller
{
    public function index(){
        $userId = Auth::user()->id;
        $data = SocialLinks::select('*')->where('user_id',$userId)->first();
        return view('Backend.Profile.general',['SocialLinks'=>$data]);
    }

    public function changeProfileImage(Request $request){
        $userId = Auth::user()->id;
        $user = User::findOrFail($userId);

        $photo = $request->get('photo');
        $data = str_replace('data:image/jpeg;base64,','',$photo);
        $file = base64_decode($data);
        $safeName = Str::random(10).'.'.'jpeg';
        $status = file_put_contents(public_path().'/uploads/profilePhoto/'.$safeName, $file);
        if($status) {
            if(file_exists(public_path().'/uploads/profilePhoto/'.$user->profile_photo['name']) && $user->profile_photo['name'] !='avatar.png'){
                unlink(public_path().'/uploads/profilePhoto/'.$user->profile_photo['name']);
            }
            $user->profile_photo = $safeName;
            $user->save();
        }
    }

    public function save(Request $request)
    {
        $userId = Auth::user()->id;
        $user = User::findOrFail($userId);
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$userId.',id',
            'mobile' => 'required|numeric',
        ]);

        $name = $request->get('name');
        $email = $request->get('email');
        $mobile = $request->get('mobile');

        $user->name = $name;
        $user->email = $email;
        $user->mobile = $mobile;
        $user->save();

        Session::flash('success', "Profile has been updated");
        return redirect()->back();
    }
}
