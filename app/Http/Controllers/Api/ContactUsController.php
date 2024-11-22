<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactUsModel;
use Exception;
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

          try{

            $save = new ContactUsModel();
            $save->first_name = $request->get('first_name');
            $save->last_name =$request->get('last_name');
            $save->phone_number =$request->get('phone_number');
            $save->email = $request->get('email');
            $save->address = $request->get('address');
            $save->save();

            return response()->json(data: ['status'=>'success', 'message'=>'Contact Send Successfully']);


          }catch(Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);  

          }


        } else {
          $data = [];
          $msg =  $validator->errors()->first();
          return response()->json(['status' => 'error', 'message' => $msg]);  

      }

    }
}
