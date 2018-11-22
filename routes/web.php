<?php

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::prefix('admin')->group(function() {
	Route::get('/login', 'Auth\AdminLoginController@showLoginForm');
	Route::post('/login', 'Auth\AdminLoginController@login');

	Route::get('/', 'Admin\AdminController@index');

	Route::resource('/root', Admin\RootFoldersController::class);
	Route::resource('/folders', Admin\FoldersController::class);
	Route::post('/files/upload', 'Admin\FilesController@store');
	Route::get('/file/download/{id}', 'Admin\FilesController@show');
	Route::delete('/file/{id}', 'Admin\FilesController@destroy');

	Route::resource('/users', Admin\UsersController::class);

	Route::get('/profile/{id}/edit', 'Admin\AdminController@edit');
	Route::patch('/profile/{id}', 'Admin\AdminController@update');

	Route::post('/search', 'Admin\SearchController@index');

	Route::get('/logout', 'Auth\AdminLoginController@logout');
});

Route::prefix('users')->group(function() {
	Route::get('/home', 'User\HomeController@index');

	Route::get('/explore', 'User\HomeController@explore');

	Route::get('/root/{id}', 'User\RootFoldersController@show');
	Route::get('/folders/{id}', 'User\FoldersController@show');
	Route::post('/files/upload', 'User\FilesController@store');
	Route::get('/file/download/{id}', 'User\FilesController@show');
	Route::delete('/file/{id}', 'User\FilesController@destroy');

	Route::get('/profile/{id}/edit', 'User\HomeController@edit');
	Route::patch('/profile/{id}', 'User\HomeController@update');

	Route::post('/search', 'User\SearchController@index');

	Route::get('/logout', 'Auth\LoginController@userLogout');
});