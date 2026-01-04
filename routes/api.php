<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\EventsController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\AirDropsController;
use App\Http\Controllers\Api\ContactUsController;
use App\Http\Controllers\Api\ServiceController;
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

Route::get('get-latest-data', [HomeController::class, 'get_latest_data']);

/// End Home Page


// Events Menu
//get all active Events
Route::get('get-events',[EventsController::class,'get_events']);
Route::post('search-events',[EventsController::class,'search_events']);

// New Event APIs
Route::get('event-list',[EventsController::class,'event_list']);
Route::get('event-detail/{slug}',[EventsController::class,'event_detail_by_slug']);
//Route::get('event-detail/{id}',[EventsController::class,'event_detail']); //old api
Route::post('create-event',[EventsController::class,'create_event']);


// Services Menu
Route::get('get-services',[ServiceController::class,'get_services']);
Route::get('service-details/{type?}',[ServiceController::class,'serviceDetails']);


//blogs
Route::get('get-blogs', [BlogController::class,'get_blogs']);
// Route::get(uri: 'get-categories','App\Http\Controllers\Api\CategoryController@categories');
//Route::get('get-blog-by-category/{slug}',['blogs_by_category']);
Route::get('category-wise-details/{slug}',[BlogController::class,'category_wise_details']);
Route::get('blog-details/{slug}',[BlogController::class,'blog_details']);
Route::get('recent-view',[BlogController::class,'recent_view']);

Route::post('save-contact-us',[ContactUsController::class,'save_contact_us']);

//Social Media
Route::get('app-detail', [ContactUsController::class, 'appDetail']);

// due page in blog;

//airdrops

Route::post('search-airdrops',[AirDropsController::class,'get_airdrops']);

Route::get('all-airdrops',[AirDropsController::class,'allArirDrops']);

Route::post('details-airdrops/{name?}',[AirDropsController::class,'details_airdrops']);



