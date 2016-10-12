<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
//    Auth::logout();
});
Route::auth(); // authetincation

Route::get('/home', 'HomeController@index');




Route::get('/verify/{code}','Auth\RegisterController@verify'); // verify code



Route::post('/ticket','TicketController@create'); // add support ticket


Route::get('login/facebook', 'Auth\AuthController@redirectToFacebook');
Route::get('login/facebook/callback', 'Auth\AuthController@getFacebookCallback');




Route::group(['prefix' => 'admin'],function(){
    Route::resource('categories','CategoryController');
});

