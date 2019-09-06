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

Route::get('login','LoginController@login_form')->name('admin.login.form');
Route::post('login','LoginController@login')->name('admin.login');

Route::middleware('auth')->prefix('admin')->group(function (){
    Route::get('dashboard','DashboardController@index')->name('admin.dashboard')->middleware('auth');

    Route::resource('category','CategoryController');
    Route::post('category/{id}/restore','CategoryController@restore')->name('category.restore');
    Route::delete('category/{id}/permanent_delete','CategoryController@permanent_delete')->name('category.permanent_delete');

    Route::resource('sub_category','SubCategoryController');
    Route::post('sub_category/{id}/restore','SubCategoryController@restore')->name('sub_category.restore');
    Route::delete('sub_category/{id}/permanent_delete','SubCategoryController@permanent_delete')->name('sub_category.permanent_delete');

    Route::resource('brand','BrandController');
    Route::post('brand/{id}/restore','BrandController@restore')->name('brand.restore');
    Route::delete('brand/{id}/permanent_delete','BrandController@permanent_delete')->name('brand.permanent_delete');

    Route::resource('product','ProductController');
    Route::post('product/{id}/restore','ProductController@restore')->name('product.restore');
    Route::delete('product/{id}/permanent_delete','ProductController@permanent_delete')->name('product.permanent_delete');


});

Route::get('emergency-logout',function (){
    auth()->logout();
    return redirect()->route('admin.login.form');
})->name('admin.logout');



