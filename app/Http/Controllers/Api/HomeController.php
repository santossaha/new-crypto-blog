<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\AdsImageModel;
use App\Models\Banner;
use App\Models\BlogCategory;
use App\Models\BlogDetail;
use Exception;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function get_sliders()
  {
    try {

      $getSliders = Banner::where('status', 'Active')->get()->toArray();
      $mySliders = array_chunk($getSliders, 3);
      return response()->json(['status' => 'success', 'data' => $mySliders]);
    } catch (Exception $e) {

      return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
    }
  }

  public function get_adds()
  {
      try {
          $currentDate = now();
          $getAdds = AdsImageModel::first();

          if ($getAdds && $getAdds->start_date && $getAdds->end_date && $getAdds->ads_image) {
              if ($currentDate->between($getAdds->start_date, $getAdds->end_date)) {
                  $image = $getAdds->ads_image;
              } else {
                  $image = $getAdds->requird_image;
              }
          } else {
              $image = $getAdds->requird_image;
          }

          return response()->json([
              'status' => 'success',
              'data' => $image
          ]);
      } catch (Exception $e) {
          return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
      }
  }

  public function get_aboutus()
  {

    try {

      $getAdds = About::first();

      return response()->json([
        'status' => 'success',
        'data' => $getAdds
      ]);
    } catch (Exception $e) {
      return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
    }
  }


  public function latest_news()
  {
    try {
      $latestNews = BlogDetail::where('type', 'News')->orderBy('id')->limit(6)->get();
      return response()->json([
        'status' => 'success',
        'data' =>  $latestNews
      ]);
    } catch (Exception $e) {
      return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
    }
  }


  public function latest_news_category(){

    try{
$data  = BlogCategory::where('type','news')->orderBy('id','desc')->get();

return response()->json(['status' => 'success', 'data'=>$data ]);

    }catch(Exception $e){

      return response()->json(['status' => 'error', 'message' => $e->getMessage()]);

    }
  }
}
