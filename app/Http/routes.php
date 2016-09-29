<?php




Route::get('/', function() {
    return view('welcome');
});

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
