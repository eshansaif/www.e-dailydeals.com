<?php

namespace App\Http\Controllers\Front;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index($category_id = false)
    {
        $products = new Product();
        $products = $products->with(['brand','category','product_image','product_attributes']);
        if($category_id != false){
            $products = $products->where('category_id',$category_id);
        }
        $products = $products->where('status','Active');
        $products = $products->orderBy('id','DESC')->paginate(6);
        $data['products'] = $products;
        //dd($data);
        return view('front.product.index',$data);
    }

    public function details($id)
    {
        //$data['categories'] = Category::where('status','Active')->orderBy('name','ASC')->pluck('name','id');
        $data['product'] = Product::with(['category','brand','product_attributes'])->findOrfail($id);
        $data['latest_products'] = Product::where('status','Active')->with(['category','brand'])->orderBy('id','DESC')->limit(6)->get();
        $data['featured_products'] = Product::where(['status'=>'Active','is_featured'=>1])->with(['category','brand'])->orderBy('id','DESC')->limit(6)->get();
        //$data['product'] = json_decode(json_encode($data['product']));
        ///dd($data);
        return view('front.product.details', $data);
    }

    public function getProductPrice(Request $request)
    {
        $data = $request->all();
        echo "<pre>"; print_r($data);
    }
}
