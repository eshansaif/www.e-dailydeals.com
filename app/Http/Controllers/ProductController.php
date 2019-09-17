<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Product;
use App\ProductAttribute;
use App\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $data['title'] = 'Product List';
        $product = new Product();
        $product = $product->withTrashed();
        if ($request->has('search') && $request->search != null){
            $product = $product->where('name','like','%'.$request->search.'%');
        }
        if ($request->has('status') && $request->status != null) {
            $product = $product->where('status',$request->status );
        }
        $product = $product->with('category','brand')->orderBy('id','DESC')->paginate(3);
        $data['products'] = $product;

        if (isset($request->status) || $request->search) {
            $render['status'] = $request->status;
            $render['search'] = $request->search;
            $product = $product->appends($render);
        }

        $data['serial'] = managePagination($product);
        return view('admin.product.index',$data);
    }


    public function create()
    {
        $data['title'] = 'Create new Product';
        $data['categories'] = Category::orderBy('name')->get();
        $data['brands'] = Brand::orderBy('name')->get();
        //$data['categories'] = Category::orderBy('name')->pluck('name','id');
        //$data['brands'] = Brand::orderBy('name')->pluck('name','id');
        return view('admin.product.create',$data);
    }


    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'name'=>'required',
            'code'=>'required',
            'category_id'=>'required',
            'brand_id'=>'required',
            'price'=>'required|numeric',
            'stock'=>'required|numeric',
            'status'=>'required',
            'images.*'=>'image',
        ]);

        $product = $request->except('_token','images');
        $product['created_by'] = 1;
        $product = Product::create($product);

        if (count($request->images))
        {
            foreach ($request->images as $image){
                $product_image['product_id'] = $product->id;
                $file_name = $product->id.'_'.time().'_'.rand(0000,9999);
                //dd($file_name);
                $image->move('images/products/', $file_name.'_'.$image->getClientOriginalName());
                $product_image['file_path'] = 'images/products/'.$file_name.'_'.$image->getClientOriginalName();
                ProductImage::create($product_image);
            }

        }

        //dd($product);

        session()->flash('message','Product is Created Successfully!');
        return redirect()->route('product.index');
    }

    public function show($id)
    {
        {
            $data['title'] = 'Product Details';
            $data['product'] = Product::with(['category','brand','product_image'])->findOrFail($id);
            //dd($data['product']);
            $data['categories'] = Category::orderBy('name')->get();
            $data['brands'] = Brand::orderBy('name')->get();
            //$data['categories'] = Category::orderBy('name')->pluck('name','id');
            //$data['brands'] = Brand::orderBy('name')->pluck('name','id');
            return view('admin.product.show',$data);
        }
    }


    public function edit(Product $product)
    {
        $data['title'] = 'Edit Product';
        $data['product'] = $product;
        $data['categories'] = Category::orderBy('name')->get();
        $data['brands'] = Brand::orderBy('name')->get();
        //$data['categories'] = Category::orderBy('name')->pluck('name','id');
        //$data['brands'] = Brand::orderBy('name')->pluck('name','id');
        return view('admin.product.edit',$data);
    }


    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'=>'required',
            'code'=>'required',
            'category_id'=>'required',
            'brand_id'=>'required',
            'price'=>'required|numeric',
            'stock'=>'required|numeric',
            'status'=>'required',
            'images.*' =>'image'
        ]);

        $product_data = $request->except('_token');
        $product_data['updated_by'] = 1;
        $product->update($product_data);

        //image upload

        if (count($request->images))
        {
            foreach ($request->images as $image){
                $product_image['product_id'] = $product->id;
                $file_name = $product->id.'_'.time().'_'.rand(0000,9999);
                //dd($file_name);
                $image->move('images/products/', $file_name.'_'.$image->getClientOriginalName());
                $product_image['file_path'] = 'images/products/'.$file_name.'_'.$image->getClientOriginalName();
                ProductImage::create($product_image);
            }

        }

        session()->flash('message','Product is Updated Successfully');
        return redirect()->route('product.index');
    }


    public function destroy(Product $product)
    {
        $product->delete();
        session()->flash('message','Product is Deleted Successfully!');
        return redirect()->route('product.index');
    }

    public function restore($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();
        session()->flash('message','Product is Restored Successfully!');
        return redirect()->route('product.index');
    }



    public function permanent_delete($id)
    {
        $product = Product::onlyTrashed()->with('product_image')->findOrFail($id);

        if(count($product->product_image)) {
            foreach ($product->product_image as $image) {
                File::delete($image->file_path);
                $image->delete();
            }
        }

        $product->forceDelete();
        session()->flash('message','Product is Permanently Deleted');
        return redirect()->route('product.index');
    }

    public function addAttributes(Request $request,$id=null)
        {

        $data['title'] = 'Product Attributes';
        $productDetails = Product::with('product_attributes')->where(['id'=>$id])->first();
        //$productDetails = json_decode(json_encode($productDetails));
        //dd($productDetails);
        if($request->isMethod('post')){
            $pa_data = $request->all();

            foreach ($pa_data['sku'] as  $key => $val){
                if (!empty($val)){
                    $attribute = new ProductAttribute();
                    $attribute->product_id = $id;
                    $attribute->created_by = 1;
                    $attribute->sku = $val;
                    $attribute->size = $pa_data['size'][$key];
                    $attribute->price = $pa_data['price'][$key];
                    $attribute->stock = $pa_data['stock'][$key];
                    $attribute->save();


                }

            }

            return redirect('admin/product/add-attributes/'.$id)->with(session()->flash('message','Product Attributes is Added Successfully!'));
        }
        //dd($productDetails);
        return view('admin.product.add_attributes',$data)->with(compact('productDetails'));


    }

    public function destroyAttributes(ProductAttribute $productAttribute)
    {
        $productAttribute->delete();
        session()->flash('message','Product Attribute is Deleted successfully!');
        return redirect()->back();
    }


    public function delete_image($image_id)
    {
        $image = ProductImage::findOrFail($image_id);
        File::delete($image->file_path);
        $image->delete();
        session()->flash('message','Product image has been permanently deleted.');
        return redirect()->back();
    }



}
