<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\BlogDetail;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BlogsResource;

class ApiController extends Controller
{
    public function categories()
	{
		try {
			$categories = BlogCategory::where('status', 'Active')->select('id', 'name', 'slug', 'type', 'status')->orderBy('id', 'desc')->get();
			return response()->json(['status' => 'success', $categories]);
		} catch (Exception $e) {
			return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
		}
	}

    public function get_blogs()
    {
      try {

        $blogs = BlogDetail::orderBy('id', 'desc')->get();
        $get_blogs = BlogsResource::collection($blogs);
        return response()->json(['status'=>'success', $get_blogs]);
      } catch (Exception $e) {
        return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
      }
    }

    public function blogDetail(Request $request){
      try{

      } catch(Exception $e){

      }
    }

    public function get_events()
	{
		try {

			$events = EventsModel::orderBy('id', 'desc')->get();
			$getEvents = EventsResource::collection($events);
			return response()->json(['status' => 'sucess', $getEvents]);
		} catch (Exception $e) {
			return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
		}
	}
}



}
