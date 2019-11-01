<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['title'] = "DailyDeals - The Online Shopping";
        //$data['categories'] = Category::where('status','Active')->orderBy('name','ASC')->pluck('name','id');
        $data['latest_products'] = Product::where('status','Active')->with(['category','brand'])->orderBy('id','DESC')->limit(6)->get();
        $data['featured_products'] = Product::where(['status'=>'Active','is_featured'=>1])->with(['category','brand'])->orderBy('id','DESC')->limit(5)->get();

        //categories
        //$data['allCategories'] = Category::with('categories')->where(['parent_id'=>0, 'status'=>'Active'])->get();
        //dd($data['allCategories']);

        /*foreach($categories as $category){
            echo $category->name; echo "<br>";
            $sub_categories = Category::where(['parent_id'=>$category->id])->get();
            foreach ($sub_categories as $sub_category){
                echo $sub_category->name; echo "<br>";

            }
        }
        die;*/

        //dd($data);
        return view('front.home', $data);

    }
}
