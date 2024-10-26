<?php

namespace App\Http\Controllers\Backend\Profile;

use App\Models\SocialLinks;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class SocialController extends Controller
{
    public function index(){
        $userId = Auth::user()->id;
        $data = SocialLinks::select('*')->where('user_id',$userId)->first();
        return view('Backend.Profile.socialLinks',['SocialLinks'=>$data]);
    }

    public function save(Request $request)
    {
        $userId = Auth::user()->id;
        $facebook = $request->get('facebook');
        $google_plus = $request->get('google_plus');
        $twitter = $request->get('twitter');
        $linkedin = $request->get('linkedin');
        $youtube = $request->get('youtube');
        $instagram = $request->get('instagram');

        $data = SocialLinks::select('*')->where('user_id',$userId)->first();
        if(!isset($data->id)){
            $user = new SocialLinks();
            $user->user_id = $userId;
        }else{
            $user = SocialLinks::findOrFail($data->id);
        }
        $user->facebook = $facebook;
        $user->google_plus = $google_plus;
        $user->twitter = $twitter;
        $user->linkedin = $linkedin;
        $user->youtube = $youtube;
        $user->instagram = $instagram;
        $user->save();

        Session::flash('success', "Social Links has been updated");
        return redirect()->back();
    }
}
