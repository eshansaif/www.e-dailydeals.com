<?php

namespace App\Http\Controllers\Front;

use App\Cart;
use App\Category;
use App\Country;
use App\DeliveryAddress;
use App\Product;
use App\ProductAttribute;
use App\ProductsAttribute;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $proArr = explode("-",$data['idsize']);
        $proAttr = ProductsAttribute::where(['product_id'=>$proArr[0],'size'=>$proArr[1]])->first();
        $getCurrencyRates = Product::getCurrencyRates($proAttr->price);
        echo $proAttr->price."-".$getCurrencyRates['USD_Rate']."-".$getCurrencyRates['GBP_Rate']."-".$getCurrencyRates['EUR_Rate'];
        echo "#";
        echo $proAttr->stock;
    }

    public function addToCart(Request $request)
    {
        $data = $request->all();
        if (empty($data['user_email'])){
            $data['user_email'] = '';
        }

        $session_id = Session::get('session_id');
        if (empty($session_id)){
            $session_id = str_random(40);
            Session::put('session_id',$session_id);
        }

        $countProducts = DB::table('cart')->where(['product_id'=>$data['product_id'],
            'color'=>$data['color'], 'size'=>$data['size'], 'session_id'=>$session_id ])->count();
        //dd($countProducts);

        if ($countProducts > 0) {
            return redirect()->back()->with(session()->flash('error_message','This Product is already exist in cart!'));
        }else{
            DB::table('cart')->insert(['product_id'=>$data['product_id'],'name'=>$data[name], 'code'=>$data['code'],
                'color'=>$data['color'], 'price'=>$data['price'], 'size'=>$data['size'],
                'quantity'=>$data['quantity'], 'user_email'=>$data['user_email'],'session_id'=>$session_id
            ]);
        }



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
        DB::table('cart')->where('id',$id)->delete();
        return redirect('cart')->with(session()->flash('error_message','The Product has been removed from Cart!'));
    }

    public function updateCartQuantity($id=null, $quantity=null)
    {
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
            dd($data);

        }
    }




}
