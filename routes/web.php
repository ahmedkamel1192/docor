<?php

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


Route::get('/', function () {

    return view('welcome');
});

Auth::routes();
Route::group(['middleware' => ['checkIfAdmin']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/categories', 'CategoriesController@index');
    Route::get('/doctors', 'DoctorsController@index');
    Route::get('/users', 'UsersController@index');
    Route::get('/events', 'EventController@index');
    Route::get('/verify/{doctor_id}', 'DoctorsController@verify');
    Route::delete('/delete/{id}', 'UsersController@destroy');
    Route::post('/block/{id}', 'UsersController@block');
    Route::get('/categories/create', 'CategoriesController@create');
    Route::post('/categories', 'CategoriesController@store');
    Route::get('/categories/{id}/edit', 'CategoriesController@edit');
    Route::put('/categories/{id}', 'CategoriesController@update');
    Route::delete('/categories/delete/{id}', 'CategoriesController@destroy');




});

