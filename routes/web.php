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

Route::get('dashboard','DashboardController@index')->name('admin.dashboard');
Route::resource('category','CategoryController');
ROute::post('category/{id}/restore','CategoryController@restore')->name('category.restore');
ROute::delete('category/{id}/permanent_delete','CategoryController@permanent_delete')->name('category.permanent_delete');
