<?php

namespace App\Http\Controllers\Front;

use App\Cart;
use App\Category;
use App\Country;
use App\Coupon;
use App\Customer;
use App\DeliveryAddress;
use App\Order;
use App\OrdersProduct;
use App\Product;
use App\ProductAttribute;
use App\ProductsAttribute;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use SoftDeletes;
//use mysql_xdevapi\Session;
//use Session;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index($category_id = false)
    {
        $data['featured_products'] = Product::where(['status'=>'Active','is_featured'=>1])->with(['category','brand'])->orderBy('id','DESC')->limit(6)->get();
        $products = new Product();
        $products = $products->with(['brand','category','product_image','product_attributes']);
        if($category_id != false){
            $data['product'] = $products->where('category_id',$category_id);
        }
        $products = $products->where('status','Active');
        $products = $products->orderBy('id','DESC')->paginate(6);
        $data['products'] = $products;
        //dd($data);
        return view('front.product.index',$data);
    }

    public function searchProducts(Request $request)
    {
        if ($request->isMethod('post')){
            $data = $request->all();
            $search_product = $data['product'];
            $products = Product::where('name','like','%'.$search_product.'%')->orWhere('code',$search_product)->where('status','Active')->paginate(4);
            return view('front.product.index')->with(compact('products','search_product'));
        }
    }



    public function details($id)
    {

        $data['product'] = Product::with(['category','brand','product_attributes'])->findOrfail($id);


        $product_details = Product::with('product_attributes')->where('id',$id)->first();
        $product_details = json_decode(json_encode($product_details));
        //dd($product_details);
        //dd($data['product_details']);


        $data['latest_products'] = Product::where('status','Active')->with(['category','brand'])->orderBy('id','DESC')->limit(6)->get();
        $data['featured_products'] = Product::where('id','!=',$id)->where(['status'=>'Active','is_featured'=>1])->with(['category','brand'])->orderBy('id','DESC')->limit(6)->get();
        $data['related_products'] = Product::where('id','!=',$id)->where(['category_id'=>$data['product']->category_id])->orderBy('id','DESC')->limit(6)->get();

        //Checking product stocks
        //$data['total_stock'] = ProductAttribute::where('product_id',$id)->sum('stock');
        $data['total_stock'] = Product::where('id',$id)->sum('stock');
        //dd($data['total_stock']);
        $data['title'] = "".$data['product']->name."";
        //dd($data['total_stock']);
        //dd($data['related_products']);
        //$data['product'] = json_decode(json_encode($data['product']));
        ///dd($data);
        return view('front.product.details', $data)->with(compact('product_details'));
    }

    public function getProductPrice(Request $request){
        $data = $request->all();
        echo "<pre>"; print_r($data); die;
        /*$proArr = explode("-",$data['idsize']);
        $proAttr = ProductsAttribute::where(['product_id'=>$proArr[0],'size'=>$proArr[1]])->first();
        $getCurrencyRates = Product::getCurrencyRates($proAttr->price);
        echo $proAttr->price."-".$getCurrencyRates['USD_Rate']."-".$getCurrencyRates['GBP_Rate']."-".$getCurrencyRates['EUR_Rate'];
        echo "#";
        echo $proAttr->stock;*/
    }

    public function addToCart(Request $request)
    {
        Session::forget('CouponAmount');
        Session::forget('CouponCode');

        $data = $request->all();



        $getProductStock = Product::where(['id'=>$data['product_id']])->first();

        if($getProductStock->stock<$data['quantity']){
            return redirect()->back()->with(session()->flash('error_message','Required Quantity is not available right now!'));
        }

        if(empty(Auth::user()->email)){
            $data['user_email'] = '';
        }else{
            $data['user_email'] = Auth::user()->email;
        }


        $session_id = Session::get('session_id');
        if (empty($session_id)){
            $session_id = str_random(40);
            Session::put('session_id',$session_id);
        }


        if (empty(Auth::check())){
            $countProducts = DB::table('cart')->where(['product_id'=>$data['product_id'],
                'color'=>$data['color'], 'size'=>$data['size'], 'session_id'=>$session_id ])->count();
            if ($countProducts > 0) {
                return redirect()->back()->with(session()->flash('error_message','This Product is already exist in cart!'));
            }
        }else{
            $countProducts = DB::table('cart')->where(['product_id'=>$data['product_id'],
                'color'=>$data['color'], 'size'=>$data['size'], 'user_email'=>$data['user_email'] ])->count();
            if ($countProducts > 0) {
                return redirect()->back()->with(session()->flash('error_message','This Product is already exist in cart!'));
            }
        }


            DB::table('cart')->insert(['product_id'=>$data['product_id'],'name'=>$data[name], 'code'=>$data['code'],
                'color'=>$data['color'], 'price'=>$data['price'], 'size'=>$data['size'],
                'quantity'=>$data['quantity'], 'user_email'=>$data['user_email'],'session_id'=>$session_id
            ]);




        return redirect('cart')->with(session()->flash('message','Product is added to Cart Successfully!'));
    }

    public function cart()
    {

        $data['title'] = "Shopping Cart";

        if (Auth::check()){
            $data['user_email'] = Auth::user()->email;
            $data['user_cart'] = DB::table('cart')->where(['user_email'=>$data['user_email']])->get();

        }else{
            $data['session_id'] = Session::get('session_id');
            $data['user_cart'] = DB::table('cart')->where(['session_id'=>$data['session_id']])->get();

        }


        //dd($data['user_cart']);
        //$data['product'] = Product::with(['category','brand','product_attributes'])->findOrfail($id);

        foreach ($data['user_cart'] as $key => $product){
            $productDetails = Product::with('product_image')->where('id',$product->product_id)->first();
            //dd($productDetails);
            $data['user_cart'][$key]->file = $productDetails->product_image[0]->file_path;
        }
        //dd($data['user_cart']);
        return view('front.product.cart', $data);
    }

    public function deleteCartProduct($id)
    {
        Session::forget('CouponAmount');
        Session::forget('CouponCode');

        DB::table('cart')->where('id',$id)->delete();
        return redirect('cart')->with(session()->flash('error_message','The Product has been removed from Cart!'));
    }

    public function applyCoupon(Request $request)
    {
        Session::forget('CouponAmount');
        Session::forget('CouponCode');

        $data = $request->all();
        $couponCount = Coupon::where(['coupon_code' => $data['coupon_code']])->count();

        if ($couponCount == 0){
            return redirect()->back()->with(session()->flash('error_message','This Coupon Code does not Exist!'));
        }else{
            $couponDetails = Coupon::where(['coupon_code' => $data['coupon_code']])->first();

            if ($couponDetails->status == "Inactive"){
                return redirect()->back()->with(session()->flash('error_message','This Coupon Code is not Active!'));
            }

            $expiry_date = $couponDetails->expiry_date;
            $current_date = date('Y-m-d');
            if ($expiry_date < $current_date){
                return redirect()->back()->with(session()->flash('error_message','This Coupon Code is Expired!'));
            }


            // Get Cart Total Amount
            $session_id = Session::get('session_id');

            if(Auth::check()){
                $user_email = Auth::user()->email;
                $userCart = DB::table('cart')->where(['user_email' => $user_email])->get();
            }else{
                $session_id = Session::get('session_id');
                $userCart = DB::table('cart')->where(['session_id' => $session_id])->get();
            }

            $total_amount = 0;
            foreach($userCart as $item){
                $total_amount = $total_amount + ($item->price * $item->quantity);
            }

            if ($couponDetails->amount_type == "Fixed"){
                $couponAmount = $couponDetails->amount;
            }else{
                $couponAmount = $total_amount * ($couponDetails->amount / 100);
            }

            Session::put('CouponAmount',$couponAmount );
            Session::put('CouponCode',$data['coupon_code'] );

            return redirect()->back()->with(session()->flash('message','This Coupon Code is successfully Applied, Now you are getting Discount on this Coupon!'));

        }
    }


    /*public function applyCoupon(Request $request){

        Session::forget('CouponAmount');
        Session::forget('CouponCode');

        $data = $request->all();
        echo "<pre>"; print_r($data); die;
        $couponCount = Coupon::where('coupon_code',$data['coupon_code'])->count();
        if($couponCount == 0){
            return redirect()->back()->with('flash_message_error','This coupon does not exists!');
        }else{
            // with perform other checks like Active/Inactive, Expiry date..

            // Get Coupon Details
            $couponDetails = Coupon::where('coupon_code',$data['coupon_code'])->first();

            // If coupon is Inactive
            if($couponDetails->status==0){
                return redirect()->back()->with('flash_message_error','This coupon is not active!');
            }

            // If coupon is Expired
            $expiry_date = $couponDetails->expiry_date;
            $current_date = date('Y-m-d');
            if($expiry_date < $current_date){
                return redirect()->back()->with('flash_message_error','This coupon is expired!');
            }

            // Coupon is Valid for Discount

            // Get Cart Total Amount
            if(Auth::check()){
                $user_email = Auth::user()->email;
                $userCart = DB::table('cart')->where(['user_email' => $user_email])->get();
            }else{
                $session_id = Session::get('session_id');
                $userCart = DB::table('cart')->where(['session_id' => $session_id])->get();
            }

            $total_amount = 0;
            foreach($userCart as $item){
                $total_amount = $total_amount + ($item->price * $item->quantity);
            }

            // Check if amount type is Fixed or Percentage
            if($couponDetails->amount_type=="Fixed"){
                $couponAmount = $couponDetails->amount;
            }else{
                $couponAmount = $total_amount * ($couponDetails->amount/100);
            }

            // Add Coupon Code & Amount in Session
            Session::put('CouponAmount',$couponAmount);
            Session::put('CouponCode',$data['coupon_code']);

            return redirect()->back()->with('flash_message_success','Coupon code successfully
                applied. You are availing discount!');

        }
    }*/

    public function updateCartQuantity($id=null, $quantity=null)
    {
        Session::forget('CouponAmount');
        Session::forget('CouponCode');

        $getCartDetails = DB::table('cart')->where('id',$id)->first();
        //dd($getCartDetails);
        $getStock = Product::where('code',$getCartDetails->code)->first();
        echo $getStock->stock; echo "--";
        $updated_quantity = $getCartDetails->quantity+$quantity;

        if ($getStock->stock >= $updated_quantity){
            DB::table('cart')->where('id',$id)->increment('quantity',$quantity);
            return redirect('cart')->with(session()->flash('message','The Product Quantity is updated Successfully!'));
        }else
            return redirect('cart')->with(session()->flash('error_message','Sorry!Required quantity is not available!'));

    }


    public function checkout(Request $request){
        $title = "Checkout-Shipping Address";
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        //dd($user_email);
        $userDetails = User::find($user_id);
        $countries = Country::get();

        //Check if Shipping Address exists
        $shippingCount = DeliveryAddress::where('user_id',$user_id)->count();
        $shippingDetails = array();
        if($shippingCount>0){
            $shippingDetails = DeliveryAddress::where('user_id',$user_id)->first();
        }

        // Update cart table with user email
        $session_id = Session::get('session_id');
         DB::table('cart')->where(['session_id'=>$session_id])->update(['user_email'=>$user_email]);

        if($request->isMethod('post')){
            $data = $request->all();
            // Return to Checkout page if any of the field is empty
            if(empty($data['billing_name']) ||
                empty($data['billing_address']) ||
                empty($data['billing_zip']) ||
                empty($data['billing_city']) ||
                empty($data['billing_district']) ||
                empty($data['billing_country']) ||
                empty($data['billing_phone']) ||

                empty($data['shipping_name']) ||
                empty($data['shipping_address']) ||
                empty($data['shipping_zip']) ||
                empty($data['shipping_city']) ||
                empty($data['shipping_district']) ||
                empty($data['shipping_country']) ||
                empty($data['shipping_phone'])){
                return redirect()->back()->with(session()->flash('error_message','Fill up all Fields to Checkout!'));
        }

            // Update User details
            User::where('id',$user_id)->update(['name'=>$data['billing_name'],'address'=>$data['billing_address'], 'zip'=>$data['billing_zip'],'city'=>$data['billing_city'],'district'=>$data['billing_district'],'country'=>$data['billing_country'],'phone'=>$data['billing_phone']]);

            if($shippingCount>0){
                // Update Shipping Address
                DeliveryAddress::where('user_id',$user_id)->update(['name'=>$data['shipping_name'],'address'=>$data['shipping_address'],'zip'=>$data['shipping_zip'],'city'=>$data['shipping_city'],'district'=>$data['shipping_district'],'country'=>$data['shipping_country'],'phone'=>$data['shipping_phone']]);

            }else{
                // Add New Shipping Address
                $shipping = new DeliveryAddress();
                $shipping->user_id = $user_id;
                $shipping->email = $user_email;
                $shipping->name = $data['shipping_name'];
                $shipping->address = $data['shipping_address'];
                $shipping->zip = $data['shipping_zip'];
                $shipping->city = $data['shipping_city'];
                $shipping->district = $data['shipping_district'];
                $shipping->country = $data['shipping_country'];
                $shipping->phone = $data['shipping_phone'];
                $shipping->save();
            }

            /*$pincodeCount = DB::table('pincodes')->where('pincode',$data['shipping_pincode'])->count();
            if($pincodeCount == 0){
                return redirect()->back()->with('flash_message_error','Your location is not available for delivery. Please enter another location.');
            }*/

            return redirect()->action('Front\ProductController@orderReview');

        }

        return view('front.product.shipping_checkout')->with(compact('userDetails','countries','shippingDetails','title'));
    }


    public function orderReview()
    {
        $data['title'] = "Order Review";
        $session_id = Session::get('session_id');
        $user_id = Auth::user()->id;
        $data['user_email'] = Auth::user()->email;
        $data[userDetails] = User::where('id',$user_id)->first();
        $data[shippingDetails] = DeliveryAddress::where('user_id',$user_id)->first();
        //dd($shippingDetails);

        $data['user_cart'] = DB::table('cart')->where(['user_email'=>$data['user_email']])->get();

        //dd($data['user_cart']);
        //$data['product'] = Product::with(['category','brand','product_attributes'])->findOrfail($id);

        foreach ($data['user_cart'] as $key => $product){
            $productDetails = Product::with('product_image')->where('id',$product->product_id)->first();
            //dd($productDetails);
            $data['user_cart'][$key]->file = $productDetails->product_image[0]->file_path;
        }

        //dd(count($data['user_cart']));
        return view('front.product.order_review', $data);

    }

    public function placeOrder(Request $request)
    {
        if ($request->isMethod('post')){
            $data = $request->all();
            $user_id = Auth::user()->id;
            $user_email = Auth::user()->email;

            $shippingDetails = DeliveryAddress::where(['email' =>$user_email])->first();
            //dd($shippingDetails);

            if(empty(Session::get('CouponCode'))){
                $coupon_code = '';
            }else{
                $coupon_code = Session::get('CouponCode');
            }

            if(empty(Session::get('CouponAmount'))){
                $coupon_amount = '';
            }else{
                $coupon_amount = Session::get('CouponAmount');
            }

            $order = new Order();
            $order->user_id = $user_id;
            $order->user_email = $user_email;
            $order->name = $shippingDetails->name;
            $order->address = $shippingDetails->address;
            $order->zip = $shippingDetails->zip;
            $order->city = $shippingDetails->city;
            $order->district = $shippingDetails->district;
            $order->country = $shippingDetails->country;
            $order->phone = $shippingDetails->phone;
            $order->coupon_code = $coupon_code;
            $order->coupon_amount = $coupon_amount;
            $order->order_status = "New";
            $order->payment_method = $data['payment_method'];
            //$order->shipping_charges = Session::get('ShippingCharges');
            $order->grand_total = $data['grand_total'];
            $order->save();


            $order_id = DB::getPdo()->lastInsertId();
            $cartProducts = DB::table('cart')->where(['user_email'=>$user_email])->get();
            foreach($cartProducts as $pro){
                $cartPro = new OrdersProduct;
                $cartPro->order_id = $order_id;
                $cartPro->user_id = $user_id;
                $cartPro->product_id = $pro->product_id;
                $cartPro->product_code = $pro->code;
                $cartPro->product_name = $pro->name;
                $cartPro->product_color = $pro->color;
                $cartPro->product_size = $pro->size;
                $cartPro->product_price = $pro->price;
                $cartPro->product_quantity = $pro->quantity;
                $cartPro->save();
            }

            Session::put('order_id',$order_id);
            Session::put('grand_total',$data['grand_total']);

            if ($data['payment_method'] == "COD"){

                $productDetails = Order::with('orders')->where('id',$order_id)->first();
                $userBillingDetails = User::where('id',$user_id)->first();

                /* COD Order Email Start */
                $email = $user_email;
                $messageData = [
                    'email' => $email,
                    'name' => $shippingDetails->name,
                    'order_id' => $order_id,
                    'productDetails' => $productDetails,
                    'userDetails' => $userBillingDetails
                ];
                Mail::send('emails.order.order_cod',$messageData,function($message) use($email){
                    $message->to($email)->subject('COD Order Placed Successfully- Daily Deals');
                });
                /* COD Order Email Ends */
                return redirect()->route('thanks');
            }else{
                return redirect()->route('paynow');
            }


        }
    }

    public function thanks()
    {
        $user_email = Auth::user()->email;
        DB::table('cart')->where('user_email',$user_email)->delete();
        return view('front.order.thanks');
    }

    public function paynow()
    {
        $user_email = Auth::user()->email;
        DB::table('cart')->where('user_email',$user_email)->delete();
        return view('front.order.paynow');
    }

    public function thanksPaynow()
    {
        return view('front.order.thanks_paynow');
    }

    public function cancelPaynow()
    {
        return view('front.order.cancel_paynow');
    }


    public function userOrders()
    {
        $data['title'] = "My Orders";
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;

        $data['orders'] = Order::with('orders')->where(['user_id'=>$user_id,'user_email'=>$user_email])->orderBy('id','DESC')->get();
        //dd($data['orders']);
        return view('front.order.user_order',$data);
    }

    public function userOrderDetails($order_id)
    {
        $data['title'] = 'Order Details';
        $user_id = Auth::user()->id;
        $data['orderDetails'] = Order::with('orders')->where('id',$order_id)->first();

        return view('front.order.user_order_details',$data);


    }

    private function _sslCommerz($data)
    {

        $post_data = array();
        $post_data['total_amount'] = $data['order']->grand_total; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";
    }

    public function viewOrders(Request $request)
    {
        $data['title'] = 'Order List';
        $order = new order();
        $order = $order->withTrashed();
        if ($request->has('search') && $request->search != null){
            $order = $order->where('order_code','like','%'.$request->search.'%');
        }
        if ($request->has('status') && $request->status != null) {
            $order = $order->where('status',$request->status );
        }
        $order = $order->with('orders')->orderBy('id','DESC')->paginate(5);
        $data['orders'] = $order;

        if (isset($request->status) || $request->search) {
            $render['status'] = $request->status;
            $render['search'] = $request->search;
            $order = $order->appends($render);
        }

        $data['serial'] = managePagination($order);
        return view('admin.order.index',$data);
    }

    public function viewOrderDetails($order_id)
    {
        $data['orderDetails'] = Order::with('orders')->where('id',$order_id)->first();
        $data['title'] = 'Order Details # '.$data['orderDetails']->id.'';
        $user_id = $data['orderDetails']->user_id;
        $data['userDetails'] = User::where('id',$user_id)->first();
        //dd($data['userDetails']);
        return view('admin.order.details',$data);
    }

    public function updateOrderStatus(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);
            Order::where('id',$data['order_id'])->update(['order_status'=>$data['order_status']]);
            return redirect()->back()->with(session()->flash('message','Order Status has been Updated Successfully!'));
        }

    }

    public function viewOrderInvoice($order_id)
    {
        $data['orderDetails'] = Order::with('orders')->where('id',$order_id)->first();
        //dd($data['orderDetails']);
        $data['title'] = 'Order Details # '.$data['orderDetails']->id.'';
        $user_id = $data['orderDetails']->user_id;
        $data['userDetails'] = User::where('id',$user_id)->first();
        //dd($data['userDetails']);
        return view('admin.order.invoice',$data);
    }






}
