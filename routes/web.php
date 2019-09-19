<?php

if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

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
//Front Routes
Route::get('/', 'HomeController@index')->name('home');
Route::get('product/{id}','Front/ProductController@index')->name('product.details');

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
    Route::get('product/{image_id}/delete/image','ProductController@delete_image')->name('product.delete.image');

    Route::match(['get','post'],'product/add-attributes/{id}','ProductController@addAttributes');
    Route::delete('product/delete-attributes/{id}','ProductController@destroyAttributes')->name('attribute.destroy');

    Route::get('product/delete-attributes/{id}','ProductController@addAttributes');

    Route::resource('user','UserController');
    Route::post('user/{id}/restore','UserController@restore')->name('user.restore');
    Route::delete('user/{id}/permanent_delete','UserController@permanent_delete')->name('user.permanent_delete');


});

Route::get('emergency-logout',function (){
    auth()->logout();
    return redirect()->route('admin.login.form');
})->name('admin.logout');



