<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Http\Resources\ServiceResource;
class ServiceController extends Controller
{
    public function get_services(){

        try{

            $columns = Schema::getColumnListing('blog_categories');

           // dd($columns);


            $services = BlogCategory::where('status','Active')->orderBy('id')->get();

            $Category = ServiceResource::collection($services);

            return response()->json([
                'status' => 'success',
                'data' =>  $services
              ]);
        }catch(Exception $e){

            return response()->json(['status'=>'error',$e->getMessage()]);
        }
        
    }
}
