<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\EventsController;
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

// Route::get('get-categories','App\Http\Controllers\Api\CategoryController@categories');
// Route::get('get-events',[EventsController::class,'get_events']);
// Route::get('get-blogs',[BlogController::class,'get_blogs']);
// Route::get('blog-detail/{slug}',[BlogController::class,'blogDetail']);

Route::get('get-categories',[ApiController::class, 'categories']);
Route::get('get-events',[ApiController::class,'get_events']);
Route::get('get-blogs',[ApiController::class,'get_blogs']);
Route::get('blog-detail/{slug}',[ApiController::class,'blogDetail']);

