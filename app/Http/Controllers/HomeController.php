<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['latest_products'] = Product::where('status','Active')
                                    ->with(['category','brand'])
                                    ->orderBy('id','DESC')
                                    ->limit(5)
                                    ->get();
        //dd($data);
        return view('front.home', $data);

    }
}
