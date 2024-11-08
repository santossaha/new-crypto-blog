<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogsResource;
use App\Http\Resources\RecentViews;
use App\Models\BlogDetail;
use App\Models\RecentViewBlogs;
use Exception;
use Illuminate\Http\Request;

class BlogController extends Controller
{

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

  public function blog_details(Request $request, $slug ){
    try{

      $blog_details =  BlogDetail::where('slug',  $slug)->first();

      // recent view 

      // check exsits or not 

      $exsits = RecentViewBlogs::where('blog_id',$blog_details->id)->count();

      if($exsits == 0){

        $RecentView = new  RecentViewBlogs();
        $RecentView->blog_id = $blog_details->id;
        $RecentView->save();
      }else{
      
        $RecentView =   RecentViewBlogs::where('blog_id',$blog_details->id)->first();
        $RecentView->blog_id = $blog_details->id;
        $RecentView->save();  
      }
      return response()->json(['status'=>'success', $blog_details]);

    } catch(Exception $e){
      return response()->json(['status' => 'error', 'message' => $e->getMessage()]);  
    }
  }


  public function recent_view(){

    try{

      $recentViews = RecentViewBlogs::orderBy('blog_id','desc')->get();
     
      $details = RecentViews::collection(  $recentViews );
      return response()->json(['status'=>'success', $$details]);

    }catch(Exception $e){
      return response()->json(['status' => 'error', 'message' => $e->getMessage()]);  
    }
  }
}
