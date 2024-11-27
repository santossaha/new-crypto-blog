<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\BlogsResource;
use App\Models\BlogDetail;
use App\Http\Resources\EventsResource;
use App\Models\EventsModel;
class ServiceController extends Controller
{
    public function get_services(){

        try{

            $columns = Schema::getColumnListing('blog_categories');
            $services = BlogCategory::where('status','Active')->groupBy('type')->orderBy('id')->get();
            $Category = ServiceResource::collection($services);
            return response()->json([
                'status' => 'success',
                'data' =>   $Category
              ]);
        }catch(Exception $e){

            return response()->json(['status'=>'error',$e->getMessage()]);
        }
        
    }


    public function service_details($type){

       if($type == 'Event'){

        $events =  EventsModel::orderBy('id', 'desc')->get();
        $getEvents =   EventsResource::collection($events);
        return response()->json(['status' => 'sucess', $getEvents]);

       }else{

        $blogs = BlogDetail::orderBy('id', 'desc')->where('type',$type)->get();
        $get_blogs = BlogsResource::collection($blogs);
        return response()->json(data: ['status'=>'success', $get_blogs]);
    }
    }
}
