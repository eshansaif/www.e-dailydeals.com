<?php

namespace App\Http\Controllers\Front;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index($id)
    {
        $data['product'] = Product::with('product_attributes')->findOrfail($id);
        //$data['product'] = json_decode(json_encode($data['product']));
        //dd($data['product']);
        return view('front.product.details', $data);
    }

    public function getProductPrice(Request $request)
    {
        $data = $request->all();
        echo "<pre>"; print_r($data);
    }
}
