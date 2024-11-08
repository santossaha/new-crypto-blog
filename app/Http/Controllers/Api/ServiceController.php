<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Exception;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function get_services(){

        try{

            $services = BlogCategory::where(['type'=>'News','status'=>'Active'])->orderBy('id')->get();

            return response()->json([
                'status' => 'success',
                'data' =>  $services
              ]);
        }catch(Exception $e){

            return response()->json(['status'=>'error',$e->getMessage()]);
        }
        
    }
}
