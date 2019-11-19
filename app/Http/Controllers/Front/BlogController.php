<?php

namespace App\Http\Controllers\Front;

use App\Category;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index()
    {


        $data['featured_posts'] = Post::with('category','user')->where('is_featured',1)->where('status','published')->limit(3)->latest()->get();
        //dd($data['featured_posts']);
        $data['recent_posts'] = Post::with('category','user')->/*where('status','published')->limit(3)->latest()->*/get();
        //dd($data['recent_posts']);
        $data['most_viewed_posts'] = Post::with('category')
            ->orderBy('total_view','DESC')
            ->limit(5)
            ->get();
        return view('front.front.home',$data);
    }
    public function blog_details($id)
    {
        $posts = Post::findOrFail($id);
        $data['blog_details'] = $posts;
        $posts->increment('total_view');
//        dd($data);
        return view('front.front.blog.details',$data);
    }
    /*public function category_blogs($id)
    {
        $data['posts'] = Post::with('category','user')->where(['category_id'=>$id,'status'=>'published'])->orderBy('id','DESC')->paginate(3);
        $data['category'] = Category::findOrFail($id);
        return view('front.front.blog.category_posts',$data);
    }*/
}
