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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

// User Routes
Route::get('/users', 'UserController@index')->name('user.index');
Route::get('/users/create', 'UserController@create')->name('user.create');
Route::get('/users/{id}/edit', 'UserController@edit')->name('user.edit');
Route::post('/users/create', 'UserController@store')->name('user.store');
Route::post('/users/{id}/edit', 'UserController@update')->name('user.update');
Route::post('/users/{id}/delete', 'UserController@destroy')->name('user.delete');

// Role Routes
Route::get('/roles', 'RoleController@index')->name('role.index');
Route::get('/roles/create', 'RoleController@create')->name('role.create');
Route::get('/roles/{id}/edit', 'RoleController@edit')->name('role.edit');
Route::post('/roles/create', 'RoleController@store')->name('role.store');
Route::post('/roles/{id}/edit', 'RoleController@update')->name('role.update');
Route::post('/roles/{id}/delete', 'RoleController@destroy')->name('role.delete');

// Entity Routes
Route::get('/entity/{type}', 'EntityController@index')->name('entity.index');
Route::get('/entity/{type}/create', 'EntityController@create')->name('entity.create');
Route::get('/entity/{type}/{id}/edit', 'EntityController@edit')->name('entity.edit');
Route::post('/entity/{type}/create', 'EntityController@store')->name('entity.store');
Route::post('/entity/{type}/{id}/edit', 'EntityController@update')->name('entity.update');
Route::post('/entity/{type}/{id}/delete', 'EntityController@destroy')->name('entity.delete');



