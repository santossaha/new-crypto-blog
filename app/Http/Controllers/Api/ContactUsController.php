<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ContactUsController extends Controller
{
    
    public function save_contact_us(Request $request){


  $msg = [
            'phone.required' => 'Enter your phone no. .',
            // 'phone.digits' => 'Enter your valid 10 digit phone no. .',
            // 'latitude.required' => 'Enter Your Latitude.',
            // 'longitude.required' => 'Enter Your Longitude.',
        ];
        $validator = Validator::make($request->all(), [
            'phone' => 'required|digits:10',
            // 'latitude' => 'required',
            // 'longitude' => 'required',
        ], $msg);

        if ($validator->passes()) {

          $data =   $request->all();

          dd($data );


        }

    }
}
