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


    public function serviceDetails($slug){
        $blogCat = BlogCategory::where('slug',$slug)->first();
        $get_blogs = BlogDetail::where('category_id',$blogCat->id)->orderBy('id', 'DESC')->paginate(10);
        return response()->json(['status'=>'success', 'data'=>$get_blogs]);
    }
}
