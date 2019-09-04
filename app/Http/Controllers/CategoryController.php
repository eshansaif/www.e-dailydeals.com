<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = 'Category List';
        $category = new Category();
        $category = $category->withTrashed();
        if ($request->has('search') && $request->search != null){
            $category = $category->where('name','like','%'.$request->search.'%');
        }
        if ($request->has('status') && $request->status != null) {
            $category = $category->where('status',$request->status );
        }
        $category = $category->orderBy('id','DESC')->paginate(3);
        $data['categories'] = $category;

        if (isset($request->status) || $request->search) {
            $render['status'] = $request->status;
            $render['search'] = $request->search;
            $category = $category->appends($render);
        }

        $data['serial'] = managePagination($category);
        return view('admin.category.index',$data);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Create new Category';
         return view('admin.category.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $category= $request->except('_token');
        $category['created_by'] = 1;
        Category::create($category);
        session()->flash('message','Category is created successfully');


        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $data['title'] = 'Edit Category';
        $data['category'] = $category;
        return view('admin.category.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'=>'required',
            'status'=>'required',
        ]);

        $category_data= $request->except('_token','_method');
        $category_data['updated_by'] = 1;
        $category->update($category_data);
        session()->flash('message','Category is updated successfully');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('message','Category is deleted successfully');
        return redirect()->route('category.index');
    }

    public function restore($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        session()->flash('message','Category is restored successfully');
        return redirect()->route('category.index');
    }



    public function permanent_delete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();
        session()->flash('message','Category is permanently deleted');
        return redirect()->route('category.index');
    }
}
