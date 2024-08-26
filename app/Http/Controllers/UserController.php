<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;


class UserController extends Controller
{
    public function login(){

    
        return view("Frontend.pages.login");     
    }

    public function register(){

        return view("Frontend.pages.register");


    }

    public function save_register(Request $request){

        // dd($request->all());

        $msg  =[

                'name.required'=>'Enter Your Name',
                'email.required'=>'Enter Your Email',
                'password.required'=> 'Enter Your Password',
        ];

      $validator = Validator::make($request->all(),[
                    'name'=>['required','string'],
                    'email'=>['required','string','email' ,'unique:users'],
                    'password'=>['required','string'],
        ],$msg);

        if($validator->fails()){
            return response()->json(['status' => 'error', 'errors' => $validator->errors()],200);

        }


        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->api_token = sha1((time()));
        $user->save();
        $user->attachRole(3);

        return response()->json(['status'=>'success','msg'=>'Register Successfully']);
    
    }


    public function check_login(Request $request){

        $msg =[
            'email.required'=>'Enter Your Valid Email',
            'password.required'=>'Enter Your Password'
        ];

        $validator = Validator::make($request->all(),[
            'email'=>['required','string'],
            'password'=>['required','string'],
        ],$msg);

        if($validator->fails()){

            return response()->json(['status'=> 'error','errors'=> $validator->errors()],200);
        }


        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){

            if(\Session::has('service_details')){
                $slug = session()->get('service_details');

                $request->session()->forget('service_details');
                        return redirect(url('/service/'. $slug));

            }

            return response()->json(['status'=> 'success','msg'=> 'Login Successfully']);

    }else{

        return response()->json(['status'=> 'login_error','msg'=> 'Invalid Credential'],200);
    }


}

}
