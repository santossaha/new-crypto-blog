<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\About;
use App\Models\Banner;
use App\Models\BlogDetail;
use App\Models\EventsModel;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Models\AdsImageModel;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function get_sliders()
    {
        try {

            $getSliders = Banner::where('status', 'Active')->get(['id', 'image', 'url']);
            $mySliders = $getSliders->map(function ($data) {
                return [
                    'id' => $data->id,
                    'image' => $data->image ? getFullPath('banner', $data->image) : '',
                    'url' => $data->url ?? '#'
                ];
            });

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
            $image = '';



            if ($getAdds && $getAdds->start_date && $getAdds->end_date && $getAdds->ads_image) {
                if ($currentDate->between($getAdds->start_date, $getAdds->end_date)) {
                    $image = getFullPath('adds', $getAdds->ads_image);
                } else {
                    $image = getFullPath('adds', $getAdds->image);
                }
            }else{
                return response()->json(['status' => 'error', 'message' => 'No Ads Found']);
            }
            return response()->json([
                'status' => 'success',
                'data' => $image,
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


    public function latest_news_category()
    {

        try {
            $data  = BlogCategory::where('type', 'news')->orderBy('id', 'desc')->get();

            return response()->json(['status' => 'success', 'data' => $data]);
        } catch (Exception $e) {

            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }


    public function get_latest_date()
    {

        try {
            $data  = BlogCategory::where('type', 'news')->orderBy('id', 'desc')->get();

            return response()->json(['status' => 'success', 'data' => $data]);
        } catch (Exception $e) {

            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function get_latest_data()
    {

        try {
            // Latest Blogs
            $latestBlog = BlogDetail::where('type', 'Blog')
            ->orderBy('id', 'desc')
            ->select('id', 'image', 'title', 'slug', 'short_description', 'created_at')
            ->take(6)
            ->get()
            ->map(function($item) {
                $item->image = getFullPath('blog_images',$item->image);
                return $item;
            });
            // Latest News
            $latestNews = BlogDetail::where('type', 'News')
            ->orderBy('id', 'desc')
            ->select('id', 'image', 'title', 'slug', 'short_description', 'created_at')
            ->take(6)
            ->get()
            ->map(function($item) {
                $item->image = getFullPath('blog_images',$item->image);
                return $item;
            });


            // Category Lists
            $blogCategories = BlogCategory::where('type', 'Blog')->orderBy('id', 'desc')->get(['id', 'name', 'type', 'slug']);
            $newsCategories = BlogCategory::where('type', 'News')->orderBy('id', 'desc')->get(['id', 'name', 'type', 'slug']);


            return response()->json([
                'status' => 'success',
                'latest_blog' => $latestBlog,
                'latest_news' => $latestNews,
                //'latest_event' => $latestEvent,
                'blog_categories' => $blogCategories,
                'news_categories' => $newsCategories,
              
            ]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
