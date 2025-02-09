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


        $rule = [
                'first_name' => 'required',
                'phone_number' => 'required|numeric',
                "email"=>'required|email',
               // "address"=>'required'
            ];
            $validator = Validator::make($request->all(), $rule);

            if($validator->fails()){
                //Return only first validation error message
                $firstError = $validator->errors()->first();
                return response()->json(['success' => false, 'message' => $firstError], 422);
            }

            try{
                $save = new ContactUsModel();
                $save->first_name = $request->get('first_name');
                $save->last_name =$request->get('last_name');
                $save->phone_number =$request->get('phone_number');
                $save->email = $request->get('email');
                $save->address = $request->get('address');
                $save->subject = $request->get('subject');
                $save->message = $request->get('message');
                $save->save();

                return response()->json(['success' => true, 'message' => 'Form submitted successfully.'],200);
            }catch(Exception $e){

                return response()->json(['success' => false, 'message' => 'Failed to submit the form. Please try again.'], 500);

            }




    }
}
