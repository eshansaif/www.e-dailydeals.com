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

// Confirm Account
Route::get('confirm/{code}','Front\CustomerController@confirmAccount');


//customer login
Route::get('login','Front\CustomerController@view_login')->name('customer.login_form');
Route::post('customer-login','Front\CustomerController@login')->name('customer.login');


//search product
Route::post('search-product','Front\ProductController@searchProducts')->name('search.products');

//customer logout
Route::get('customer-logout','Front\CustomerController@logout')->name('customer.logout');

//check subscribers
Route::post('check-subscriber-email','Front\NewsletterSubscriberController@checkSubscriber');

//add subscribers
Route::post('add-subscriber-email','Front\NewsletterSubscriberController@addSubscriber');


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


Route::get('get-product-price','Front\ProductController@getProductPrice');


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



Route::middleware('adminlogin')->prefix('admin')->group(function (){
    Route::get('dashboard','DashboardController@index')->name('admin.dashboard')->middleware('adminlogin');

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


    Route::resource('admin','AdminController');
    Route::post('admin/{id}/restore','AdminController@restore')->name('admin.restore');
    Route::delete('admin/{id}/permanent_delete','AdminController@permanent_delete')->name('admin.permanent_delete');

    Route::resource('coupon','CouponController');
    Route::post('coupon/{id}/restore','CouponController@restore')->name('coupon.restore');
    Route::delete('coupon/{id}/permanent_delete','CouponController@permanent_delete')->name('coupon.permanent_delete');

    //View Orders
    Route::get('orders', 'Front\ProductController@viewOrders')->name('order.index');

    //View order Details
    Route::get('orders/{id}', 'Front\ProductController@viewOrderDetails')->name('order.details');

    //Order Invoice
    Route::get('orders-invoice/{id}', 'Front\ProductController@viewOrderInvoice')->name('order.invoice');

    //update Order Status
    Route::post('update-order-status','Front\ProductController@updateOrderStatus')->name('order.status.update');


    //View Registered Users
    Route::get('view-customers','UserController@viewCustomers')->name('admin.customer.view');

    //view subscriber
    Route::get('view-subscriber','Front\NewsletterSubscriberController@index')->name('subscriber.index');

    //Update subscriber
    Route::get('update-newsletter-status/{id}/{status}','Front\NewsletterSubscriberController@updateStatus');

    //delete subscriber email
    Route::get('delete-newsletter-email/{id}','Front\NewsletterSubscriberController@deleteSubscriber');

    //Export Newsletter email
    Route::get('export-newsletter-emails','Front\NewsletterSubscriberController@exportSubscribers')->name('newsletter.export');

    Route::get('subscriber/{id}/edit','Front\NewsletterSubscriberController@index')->name('subscriber.edit');
    Route::get('subscriber/{id}','Front\NewsletterSubscriberController@index')->name('subscriber.update');
    Route::delete('subscriber/{id}','Front\NewsletterSubscriberController@destroy')->name('subscriber.destroy');
    Route::post('subscriber/{id}/restore','Front\NewsletterSubscriberController@restore')->name('subscriber.restore');
    Route::delete('subscriber/{id}/permanent_delete','Front\NewsletterSubscriberController@permanent_delete')->name('subscriber.permanent_delete');


    //admin logout
    Route::get('logout','LoginController@logout')->name('admin.logout');
});

Route::match(['get','post'],'contact-us','PageController@contactUs')->name('page.contact_us');


/*Route::get('emergency-logout',function (){
    auth()->logout();
    return redirect()->route('admin.login.form');
})->name('admin.logout');*/



