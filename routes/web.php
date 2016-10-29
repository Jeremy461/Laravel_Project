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

Route::get('/home', [
    'as' => 'dashboard',
    'uses' => 'HomeController@index'
]);

//Route::get('/home', 'HomeController@index');

Route::post('/createpost/{song_id}', [
    'as' => 'create.post',
    'uses' => 'PostController@create',
    'middleware' => 'auth'
]);

//Route::get('/dashboard', [
//    'uses' => 'SongController@getDashboard',
//    'as' => 'dashboard'
//]);

Route::post('/delete-song/{song_id}', [
    'uses' => 'SongController@deleteSong',
    'as' => 'delete.song',
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
    'uses' => 'SongController@addLike',
    'as' => 'like'
]);

Route::post('/dislike/{post_id}', [
    'uses' => 'SongController@addDislike',
    'as' => 'dislike'
]);

Route::post('/search_user', [
    'uses' => 'SearchController@searchUser',
    'as' => 'search.user'
]);

Route::post('/search_song', [
    'uses' => 'SearchController@searchSong',
    'as' => 'search.song'
]);

Route::post('/upload', [
    'uses' => 'SongController@upload',
    'as' => 'upload.song'
]);

Route::get('song/{path}', [
    'uses' => 'SongController@getSong',
    'as' => 'get.song'
]);

Route::get('/users', [
    'uses' => 'AdminController@getUsers',
    'as' => 'users',
    'middleware' => 'auth'
]);

Route::post('/users/delete{user_id}', [
    'uses' => 'AdminController@deleteUser',
    'as' => 'delete.user',
    'middleware' => 'auth'
]);

