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

Route::group(['middleware' => ['jwt.auth','CheckIfBlocked']], function () {
    Route::post('addToFavourite','Api\ADDToFavouriteController@add_to_favourite');
    Route::post('removeFromFavourite','Api\ADDToFavouriteController@remove_from_favourite');

    Route::get('favouriteDoctors','Api\ADDToFavouriteController@favourites');

    Route::get('categories/{id}','Api\CategoriesController@getDoctorsByCategory');
    Route::post('updatelocation','Api\LocationController@updateLocation');
    Route::post('getDoctorLocation','Api\LocationController@getDoctorLocation');
    Route::post('getNearestDoctorsWithCategory','Api\LocationController@getNearestDoctorsWithCategory');
    Route::post('Rate','Api\RatesController@addRate');
    Route::post('getTotalRate','Api\RatesController@getTotalRate');
    Route::post('setDeviceToken','Api\UsersController@setDeviceToken');
    Route::post('allVerifiedAndNonBlockedDoctors','Api\UsersController@allVerifiedAndNonBlockedDoctors');

    Route::post('beOnLine','Api\UsersController@beOnLine');
    Route::post('beOffLine','Api\UsersController@beOffLine');
    Route::post('requestDoctor','Api\NotificationController@requestDoctor');
    Route::post('confirmTheRequest','Api\NotificationController@confirmTheRequest');
    Route::post('endExamine','Api\NotificationController@endExamine');

});
    Route::get('categories','Api\CategoriesController@index');


