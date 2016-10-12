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
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::post('users/createpost', [
    'as' => 'create.post',
    'uses' => 'PostController@create',
    'middleware' => 'auth'
]);

Route::get('/dashboard', [
    'uses' => 'PostController@getDashboard',
    'as' => 'dashboard',
    'middleware' => 'auth'
]);

Route::post('/delete-post/{post_id}', [
    'uses' => 'PostController@deletePost',
    'as' => 'delete.post',
    'middleware' => 'auth'
]);

Route::get('/editprofile', [
    'uses' => 'ProfileController@editProfile',
    'as' => 'profile',
    'middleware' => 'auth'
]);

Route::post('/updateprofile', [
    'uses' => 'ProfileController@updateProfile',
    'as' => 'update.profile'
]);

Route::get('/profileimage/{filename}', [
    'uses' => 'ProfileController@getProfileImage',
    'as' => 'profile.image'
]);

Route::get('/user/{userid}', [
    'uses' => 'ProfileController@getProfile',
    'as' => 'getProfile'
]);

Route::post('/like/{post_id}', [
    'uses' => 'PostController@addLike',
    'as' => 'like'
]);

Route::post('/dislike/{post_id}', [
    'uses' => 'PostController@addDislike',
    'as' => 'dislike'
]);

Route::post('/search_user', [
    'uses' => 'SearchController@searchUser',
    'as' => 'search.user'
]);
