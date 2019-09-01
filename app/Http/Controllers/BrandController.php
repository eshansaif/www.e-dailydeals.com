<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title'] = 'Brand List';
        $brand = new Brand();
        $brand = $brand->withTrashed();
        if ($request->has('search') && $request->search != null){
            $brand = $brand->where('name','like','%'.$request->search.'%');
        }
        if ($request->has('status') && $request->status != null) {
            $brand = $brand->where('status',$request->status );
        }
        $brand = $brand->orderBy('id','DESC')->paginate(3);
        $data['brands'] = $brand;

        if (isset($request->status) || $request->search) {
            $render['status'] = $request->status;
            $render['search'] = $request->search;
            $brand = $brand->appends($render);
        }

        $data['serial'] = managePagination($brand);
        return view('admin.Brand.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Create new Brand';
        return view('admin.brand.create',$data);
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
            'details' => 'required',
            'status' => 'required',
            'file' => 'image',
        ]);

        $brand= $request->except('_token');

        //file upload
        if ($request->hasFile('file')){
            $file = $request->file('file');
            $file->move('images/brands/',$file->getClientOriginalName());
            $brand['file'] = 'images/brands/'.$file->getClientOriginalName();
        }


        $brand['created_by'] = 1;
        Brand::create($brand);
        session()->flash('message','Brand is Created Successfully');
        return redirect()->route('brand.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        $data['title'] = 'Edit Brand';
        $data['brand'] = $brand;
        return view('admin.brand.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name'=>'required',
            'details'=>'required',
            'status'=>'required',
        ]);

        $brand_data= $request->except('_token','_method');

        //file upload
        if ($request->hasFile('file')){
            $file = $request->file('file');
            $file->move('images/brands/',$file->getClientOriginalName());
            File::delete($brand->file);
            $brand_data['file'] = 'images/brands/'.$file->getClientOriginalName();
        }

        $brand_data['updated_by'] = 1;
        $brand->update($brand_data);
        session()->flash('message','Brand is updated successfully');
        return redirect()->route('brand.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        session()->flash('message','Brand is deleted successfully');
        return redirect()->route('brand.index');
    }

    public function restore($id)
    {
        $brand = Brand::onlyTrashed()->findOrFail($id);
        $brand->restore();
        session()->flash('message','Brand is restored successfully');
        return redirect()->route('brand.index');
    }



    public function permanent_delete($id)
    {
        $brand = Brand::onlyTrashed()->findOrFail($id);
        $brand->forceDelete();
        session()->flash('message','Brand is permanently deleted');
        return redirect()->route('brand.index');
    }
}
