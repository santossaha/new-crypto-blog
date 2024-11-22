<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ContactUsController extends Controller
{
    
    public function save_contact_us(Request $request){


  $msg = [
            'first_name.required' => 'Enter your First  name.',
            'last_name.required' => 'Enter your Last Name',
            'phone_number.required' => 'Enter Your Phone Number.',
            'email.required' => 'Enter Your Email.',
            'address.required' => 'Enter Your Address.',
        ];
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',
            "email"=>'required',
            "address"=>'required'
        ], $msg);

        if ($validator->passes()) {

          $data =   $request->all();

          dd($data );


        }

    }
}
