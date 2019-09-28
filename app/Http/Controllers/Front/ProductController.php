<?php

namespace App\Http\Controllers\Front;

use App\Category;
use App\Product;
use App\ProductAttribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        //dd($data);
        $proArr = explode("-",$data['idSize']);
        $proAttr = ProductAttribute::where(['product_id' => $proArr[0],'size' => $proArr[1]])->first();
        echo $proAttr->price;
        echo "#";
        echo $proAttr->size;

    }
}
