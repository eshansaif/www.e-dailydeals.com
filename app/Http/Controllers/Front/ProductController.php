<?php

namespace App\Http\Controllers\Front;

use App\Category;
use App\Product;
use App\ProductAttribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
//use mysql_xdevapi\Session;
use Session;

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
        $data['product_details'] = json_decode(json_encode($product_details));
        //dd($data['product_details']);
        $data['latest_products'] = Product::where('status','Active')->with(['category','brand'])->orderBy('id','DESC')->limit(6)->get();
        $data['featured_products'] = Product::where('id','!=',$id)->where(['status'=>'Active','is_featured'=>1])->with(['category','brand'])->orderBy('id','DESC')->limit(6)->get();
        $data['related_products'] = Product::where('id','!=',$id)->where(['category_id'=>$data['product']->category_id])->orderBy('id','DESC')->limit(6)->get();

        $data['total_stock'] = ProductAttribute::where('product_id',$id)->sum('stock');
        $data['title'] = "".$data['product']->name."";
        //dd($data['total_stock']);
        //dd($data['related_products']);
        //$data['product'] = json_decode(json_encode($data['product']));
        ///dd($data);
        return view('front.product.details', $data);
    }

    public function getProductPrice(Request $request)
    {
        $data = $request->all();
        dd($data);
        $proArr = explode("-",$data['idSize']);
        $proAttr = ProductAttribute::where(['product_id' => $proArr[0],'size' => $proArr[1]])->first();
        echo $proAttr->price;
        /*echo "#";
        echo $proAttr->size;*/

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


        DB::table('cart')->insert(['product_id'=>$data['product_id'],'name'=>$data[name], 'code'=>$data['code'],
            'color'=>$data['color'], 'price'=>$data['price'], 'size'=>$data['size'],
            'quantity'=>$data['quantity'], 'user_email'=>$data['user_email'],'session_id'=>$session_id
        ]);

        return redirect('cart')->with(session()->flash('message','Product is added to Cart Successfully!'));
    }

    public function cart($id)
    {
        $data['title'] = "Cart";
        $data['session_id'] = Session::get('session_id');
        $data['user_cart'] = DB::table('cart')->where(['session_id'=>$data['session_id']])->get();
        //$data['product'] = Product::with(['category','brand','product_attributes'])->findOrfail($id);

        foreach ($data['user_cart'] as $key => $product){
            $productDetails = Product::with('product_image')->where('id',$product->product_id)->first($id);
            //dd($productDetails);
            $data['user_cart'][$key]->file = $productDetails->product_image[0]->file_path;
        }
        //dd($data['user_cart']);
        return view('front.product.cart', $data);
    }
}
