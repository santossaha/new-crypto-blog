<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\EventsController;
use App\Http\Controllers\Api\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/// Home Page ///

Route::get('get-sliders',[HomeController::class,'get_sliders']);
Route::get('get-adds',[HomeController::class,'get_adds']);
Route::get('get-aboutus',[HomeController::class,'get_aboutus']);
Route::get('latest-news',[HomeController::class,'latest_news']);
Route::get('latest-news-category',[HomeController::class,'latest_news_category']);

/// End Home Page


// Events Menu
Route::post('search-events',[EventsController::class,'get_events']);


// Services Menu
Route::get('get-services','App\Http\Controllers\Api\ServiceController@get_services');

//blogs
Route::get('get-blogs',action: [BlogController::class,'get_blogs']);
// Route::get(uri: 'get-categories','App\Http\Controllers\Api\CategoryController@categories');
Route::get('get-blog-by-category/{slug}',['blogs_by_category']);
Route::get('blog-details/{slug}',[BlogController::class,'blog_details']);
Route::get('recent-view',[BlogController::class,'recent_view']);

// due page in blog



