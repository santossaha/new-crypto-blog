<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get("/",['as'=>'home','uses'=>'App\Http\Controllers\FrontendController@index']);
Route::get('about',['as'=> 'about','uses'=> 'App\Http\Controllers\FrontendController@about']);
Route::get('service',['as'=> 'service','uses'=>'App\Http\Controllers\FrontendController@service']);
Route::get('service/{slug?}/{id?}',['as'=> 'service_details','uses'=> 'App\Http\Controllers\FrontendController@service_details']);
Route::get('contact',['as'=> 'contact_us','uses'=> 'App\Http\Controllers\FrontendController@contact']);
Route::get('asylum',['as'=> 'asylum','uses'=>'App\Http\Controllers\FrontendController@asylum']);
Route::get('login',['as'=> 'user_login','uses'=> 'App\Http\Controllers\UserController@login']);
Route::post('login-check',['as'=> 'check_login','uses'=> 'App\Http\Controllers\UserController@check_login']);
Route::get('register',['as'=> 'user_register','uses'=> 'App\Http\Controllers\UserController@register']);
Route::post('save-register',['as'=> 'save_register','uses'=> 'App\Http\Controllers\UserController@save_register']);


Route::group(['middleware'=> 'UserMiddleware'], function () {

Route::get('dashboard',['as'=> 'user_dashboard','uses'=>'App\Http\Controllers\UserDashboardController@dashboard']);

});
