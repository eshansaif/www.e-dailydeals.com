<?php

namespace App\Http\Controllers;

use App\Author;
use App\Category;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

    public function index(Request $request)
    {

        $data['title'] = 'Post List';
        $post = new Post();
        $post = $post->withTrashed();
        if ($request->has('search') && $request->search != null){
            $post = $post->where('name','like','%'.$request->search.'%');
        }
        if ($request->has('status') && $request->status != null) {
            $post = $post->where('status',$request->status );
        }
        $post = $post->with('category','user')->orderBy('id','desc')->orderBy('id','DESC')->paginate(10);
        $data['posts'] = $post;

        if (isset($request->status) || $request->search) {
            $render['status'] = $request->status;
            $render['search'] = $request->search;
            $post = $post->appends($render);
        }

        $data['serial'] = managePagination($post);
        return view('admin.post.index',$data);
        
        
        

        /*$data['title'] = 'Post List';
        $data['posts'] = Post::with('category','user')->orderBy('id','desc')->get();
//        dd($data);
        $data['serial'] = 1;
        return view('admin.post.index',$data);*/
    }


    public function create()
    {
        $data['title'] = 'Create new post';
        $data['categories'] = Category::orderBy('name')->get();
        $data['users'] = User::orderBy('name')->get();
        return view('admin.post.create',$data);
    }


    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'category_id'=>'required',
            'user_id'=>'required',
            'title'=>'required',
            'details'=>'required',
            'status'=>'required',
        ]);
        $post = $request->except('_token');


        // File upload
        /*if($request->hasFile('file')) {
            $file = $request->file('file');
            $file->move('images/post/', $file->getClientOriginalName());
            $post['file'] = 'images/post/'.$file->getClientOriginalName();
        }*/

        Post::create($post);
        session()->flash('message','Post created successfully!');
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $data['title'] = 'Edit post';
        $data['post'] = $post;
        $data['categories'] = Category::orderBy('name')->get();
        $data['users'] = User::orderBy('name')->get();
        return view('admin.post.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'category_id'=>'required',
            'user_id'=>'required',
            'title'=>'required',
            'details'=>'required',
            'status'=>'required',
        ]);

        $post_r = $request->except('_token');
        // File upload
        if($request->hasFile('file')) {
            $file = $request->file('file');
            $file->move('images/post/', $file->getClientOriginalName());
            File::delete($post->file);
            $post_r['file'] = 'images/post/'.$file->getClientOriginalName();
        }
        $post->update($post_r);
        session()->flash('message','Post updated successfully');
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        session()->flash('message','Post deleted successfully!');
        return redirect()->route('post.index');
    }


    public function restore($id)
    {
        $brand = Post::onlyTrashed()->findOrFail($id);
        $brand->restore();
        session()->flash('message','Post is restored successfully!');
        return redirect()->route('post.index');
    }



    public function permanent_delete($id)
    {
        $brand = Post::onlyTrashed()->findOrFail($id);
        $brand->forceDelete();
        session()->flash('message','Post is permanently deleted!');
        return redirect()->route('post.index');
    }
}
