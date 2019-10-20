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

//customer registration
Route::get('register','Front\CustomerController@view_register')->name('customer.register_form');
Route::post('customer_register','Front\CustomerController@register')->name('customer.register');


//customer login
Route::get('login','Front\CustomerController@view_login')->name('customer.login_form');
Route::post('customer-login','Front\CustomerController@login')->name('customer.login');

//customer logout
Route::get('customer-logout','Front\CustomerController@logout')->name('customer.logout');

//middleware(Routes after customer login)
Route::group(['middleware'=>['frontlogin']],function (){

    //Customer account
    Route::match(['get','post'],'account','Front\CustomerController@account')->name('customer.account');

    // Check User Current Password
    Route::post('check-user-pwd','Front\CustomerController@chkUserPassword');

    // Update User Password
    Route::post('update-user-pwd','Front\CustomerController@updatePassword');

    //checkout
    Route::match(['get','post'],'checkout','Front\ProductController@checkout')->name('checkout');

    Route::match(['get','post'],'order-review','Front\ProductController@orderReview')->name('order_review');

    //Place order
    Route::match(['get','post'],'place-order','Front\ProductController@placeOrder')->name('place_order');


    //Route::match(['get','post'],'place-order/{}','Front\ProductController@placeOrder')->name('place_order');



    //Thanks Page
    Route::get('thanks','Front\ProductController@thanks')->name('thanks');

    //Thanks Page for Pay Now
    Route::get('paynow','Front\ProductController@paynow')->name('paynow');
    Route::get('paynow/thanks','Front\ProductController@thanksPaynow')->name('paynow.thanks');
    Route::get('paypal/cancel','Front\ProductController@cancelPaynow')->name('paypal.cancel');

    //Show Orders
    Route::get('orders','Front\ProductController@userOrders')->name('orders');

    //Oder Details
    Route::get('orders/{id}','Front\ProductController@userOrderDetails')->name('orders.details');



});

//Route::match(['GET','POST'],'register','Front\CustomerController@register')->name('customer.register');

Route::match(['GET','POST'],'check-email','Front\CustomerController@checkEmail');

//Front Routes
Route::get('/', 'HomeController@index')->name('home');
Route::get('products/{id?}','Front\ProductController@index')->name('front.product.index');
Route::get('product/{id}','Front\ProductController@details')->name('product.details');


Route::get('product/get-product-price/{idSize}','Front\ProductController@getProductPrice');


Route::match(['get', 'post'], 'add-to-cart', 'Front\ProductController@addToCart' )->name('add-cart');

Route::match(['get', 'post'], 'cart','Front\ProductController@cart')->name('cart');

//delete product from cart item
Route::get('cart/delete-product/{id}','Front\ProductController@deleteCartProduct')->name('cart.delete');

//coupon code
Route::post('cart/apply-coupon','Front\ProductController@applyCoupon')->name('cart.apply_coupon');

//update product quantity
Route::get('cart/update-quantity/{id}/{quantity}','Front\ProductController@updateCartQuantity');

// user login/registration


Route::prefix('admin')->group(function () {
    Route::get('login','LoginController@login_form')->name('admin.login.form');
    Route::post('login','LoginController@login')->name('admin.login');
});



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
    Route::get('product/{id}/delete/add-attributes','ProductController@destroyAttributes')->name('product_attribute.delete');
    Route::get('product/delete-attributes/{id}','ProductController@addAttributes');

    Route::resource('user','UserController');
    Route::post('user/{id}/restore','UserController@restore')->name('user.restore');
    Route::delete('user/{id}/permanent_delete','UserController@permanent_delete')->name('user.permanent_delete');

    Route::resource('coupon','CouponController');
    Route::post('coupon/{id}/restore','CouponController@restore')->name('coupon.restore');
    Route::delete('coupon/{id}/permanent_delete','CouponController@permanent_delete')->name('coupon.permanent_delete');

    Route::get('orders', 'Front\ProductController@viewOrders')->name('order.index');


});

Route::get('emergency-logout',function (){
    auth()->logout();
    return redirect()->route('admin.login.form');
})->name('admin.logout');



