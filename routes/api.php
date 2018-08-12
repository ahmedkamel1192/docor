<?php

use Illuminate\Http\Request;

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
//
//Route::middleware('jwt.auth')->get('users', function(Request $request) {
//    return auth()->user();
//});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('user/register/{type}', 'Api\APIRegisterController@register');
//Route::post('doctor/register', 'APIRegisterController@register');
Route::post('user/login', 'Api\APILoginController@login');

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::post('addToFavourite','Api\ADDToFavouriteController@add_to_favourite');
    Route::get('categories','Api\CategoriesController@index');
    Route::get('categories/{id}','Api\CategoriesController@getDoctorsByCategory');
    Route::post('updatelocation','Api\LocationController@updateLocation');
    Route::post('getNearestDoctorsWithCategory','Api\LocationController@getNearestDoctorsWithCategory');
    Route::post('Rate','Api\RatesController@addRate');
    Route::post('getTotalRate','Api\RatesController@getTotalRate');




});
Route::post('notify','Api\NotificationController@sendNotification');


