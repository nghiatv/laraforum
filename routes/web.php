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

//Route::get('/', function () {
//    return view('sites.index');
////    Auth::logout();
//});
Route::auth(); // authetincation

Route::get('/home', 'HomeController@index');


Route::get('/verify/{code}', 'Auth\RegisterController@verify'); // verify code


//Route::post('/ticket','TicketController@create'); // add support ticket


Route::get('login/facebook', 'Auth\AuthController@redirectToFacebook');
Route::get('login/facebook/callback', 'Auth\AuthController@getFacebookCallback');


Route::group(['prefix' => 'admin'], function () {
    Route::resource('categories', 'CategoryController');
    Route::resource('posts', 'PostController');


    Route::post('/posts/uploadimage', 'PostController@uploadImage')->name('post_upload_image');

    Route::resource('tickets', 'TicketController', ['only' => [
        'index', 'show', 'destroy', 'store'
    ]]);
});


// site route
Route::get('/', 'SiteController@index');
Route::get('/posts/{id}', 'SiteController@show');

Route::get('/categories', 'SiteController@listCategories');
Route::get('categories/{id}', 'SiteController@showCategory');


//comment

Route::resource('/post/{post}/comment', 'CommentController', ['only' => [
    'store', 'index'
]]);



// log viewer

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');