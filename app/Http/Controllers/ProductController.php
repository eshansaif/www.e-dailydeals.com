<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Exports\productsExport;
use App\Order;
use App\Product;
use App\ProductAttribute;
use App\ProductImage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Dompdf\Dompdf;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        if(Session::get(adminDetails)['products_access']==0){
            return redirect('admin/dashboard')->with(session()->flash('error_message','You have no access to this Section!'));
        }
        $data['title'] = 'Product List';
        $product = new Product();
        $product = $product->withTrashed();
        if ($request->has('search') && $request->search != null) {
            $product = $product->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->has('status') && $request->status != null) {
            $product = $product->where('status', $request->status);
        }
        $product = $product->with('category', 'brand')->orderBy('id', 'DESC')->paginate(3);
        $data['products'] = $product;

        if (isset($request->status) || $request->search) {
            $render['status'] = $request->status;
            $render['search'] = $request->search;
            $product = $product->appends($render);
        }

        $data['serial'] = managePagination($product);
        return view('admin.product.index', $data);
    }


    public function create()
    {
        $data['title'] = 'Create new Product';
        $data['categories'] = Category::orderBy('name')->get();
        $data['brands'] = Brand::orderBy('name')->get();
        //$data['categories'] = Category::orderBy('name')->pluck('name','id');
        //$data['brands'] = Brand::orderBy('name')->pluck('name','id');
        return view('admin.product.create', $data);
    }


    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z]+$/u|max:255',
            'code' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'status' => 'required',
            'images.*' => 'image',
        ]);

        $product = $request->except('_token', 'images');
        $product['created_by'] = 1;
        $product = Product::create($product);

        if (count($request->images)) {
            foreach ($request->images as $image) {
                $product_image['product_id'] = $product->id;
                $file_name = $product->id . '_' . time() . '_' . rand(0000, 9999);
                //dd($file_name);
                $image->move('images/products/', $file_name . '_' . $image->getClientOriginalName());
                $product_image['file_path'] = 'images/products/' . $file_name . '_' . $image->getClientOriginalName();
                ProductImage::create($product_image);
            }

        }

        //dd($product);

        session()->flash('message', 'Product is Created Successfully!');
        return redirect()->route('product.index');
    }

    public function show($id)
    {
        {
            $data['title'] = 'Product Details';
            $data['product'] = Product::with(['category', 'brand', 'product_image'])->findOrFail($id);
            //dd($data['product']);
            $data['categories'] = Category::orderBy('name')->get();
            $data['brands'] = Brand::orderBy('name')->get();
            //$data['categories'] = Category::orderBy('name')->pluck('name','id');
            //$data['brands'] = Brand::orderBy('name')->pluck('name','id');
            return view('admin.product.show', $data);
        }
    }


    public function edit(Product $product)
    {
        if(Session::get(adminDetails)['products_access']==0){
            return redirect('admin/dashboard')->with(session()->flash('error_message','You have no access to this Section!'));
        }
        $data['title'] = 'Edit Product';
        $data['product'] = $product;
        $data['categories'] = Category::orderBy('name')->get();
        $data['brands'] = Brand::orderBy('name')->get();
        //$data['categories'] = Category::orderBy('name')->pluck('name','id');
        //$data['brands'] = Brand::orderBy('name')->pluck('name','id');
        return view('admin.product.edit', $data);
    }


    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'status' => 'required',
            'images.*' => 'image'
        ]);

        $product_data = $request->except('_token');
        if (!$request->has('is_featured')) {
            $product_data['is_featured'] = 0;
        }
        $product_data['updated_by'] = 1;
        $product->update($product_data);

        //image upload

        if (count($request->images)) {
            foreach ($request->images as $image) {
                $product_image['product_id'] = $product->id;
                $file_name = $product->id . '_' . time() . '_' . rand(0000, 9999);
                //dd($file_name);
                $image->move('images/products/', $file_name . '_' . $image->getClientOriginalName());
                $product_image['file_path'] = 'images/products/' . $file_name . '_' . $image->getClientOriginalName();
                ProductImage::create($product_image);
            }

        }

        session()->flash('message', 'Product is Updated Successfully');
        return redirect()->route('product.index');
    }


    public function destroy(Product $product)
    {
        if(Session::get(adminDetails)['products_access']==0){
            return redirect('admin/dashboard')->with(session()->flash('error_message','You have no access to this Section!'));
        }
        $product->delete();
        session()->flash('message', 'Product is Deleted Successfully!');
        return redirect()->route('product.index');
    }

    public function restore($id)
    {
        if(Session::get(adminDetails)['products_access']==0){
            return redirect('admin/dashboard')->with(session()->flash('error_message','You have no access to this Section!'));
        }
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();
        session()->flash('message', 'Product is Restored Successfully!');
        return redirect()->route('product.index');
    }


    public function permanent_delete($id)
    {
        if(Session::get(adminDetails)['products_access']==0){
            return redirect('admin/dashboard')->with(session()->flash('error_message','You have no access to this Section!'));
        }
        $product = Product::onlyTrashed()->with('product_image')->findOrFail($id);

        if (count($product->product_image)) {
            foreach ($product->product_image as $image) {
                File::delete($image->file_path);
                $image->delete();
            }
        }

        $product->forceDelete();
        session()->flash('message', 'Product is Permanently Deleted');
        return redirect()->route('product.index');
    }

    public function addAttributes(Request $request, $id = null)
    {

        $data['title'] = 'Product Attributes';
        $productDetails = Product::with('product_attributes')->where(['id' => $id])->first();
        //$productDetails = json_decode(json_encode($productDetails));
        //dd($productDetails);
        if ($request->isMethod('post')) {
            $pa_data = $request->all();

            foreach ($pa_data['sku'] as $key => $val) {
                if (!empty($val)) {

                    //prevent duplicate SKU check
                    $attrCountSKU = ProductAttribute::where('sku', $val)->count();
                    if ($attrCountSKU > 0) {
                        return redirect('admin/product/add-attributes/' . $id)->with(session()->flash('error_message', 'This SKU is already exists! Please Add another SKU!'));
                    }

                    //prevent duplicate size check

                    $attrCountSizes = ProductAttribute::where(['product_id' => $id, 'size' => $pa_data['size'][$key]])->count();
                    if ($attrCountSizes > 0) {
                        return redirect('admin/product/add-attributes/' . $id)->with(session()->flash('error_message', '"' . $pa_data['size'][$key] . '" size is already exists for this product! Please Add another Size!'));
                    }

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

            return redirect('admin/product/add-attributes/' . $id)->with(session()->flash('message', 'Product Attributes is Added Successfully!'));
        }
        //dd($productDetails);
        return view('admin.product.add_attributes', $data)->with(compact('productDetails'));


    }

    public function destroyAttributes($id)
    {
        $product_attribute = ProductAttribute::findOrFail($id);
        $product_attribute->delete();
        session()->flash('message', 'Product Attribute has been permanently deleted!');
        return redirect()->back();
    }


    public function delete_image($image_id)
    {
        $image = ProductImage::findOrFail($image_id);
        File::delete($image->file_path);
        $image->delete();
        session()->flash('message', 'Product image has been permanently deleted!');
        return redirect()->back();
    }

    public function exportProductExcel()
    {
        return Excel::download(new productsExport(), 'products.xlsx');
    }

    public function viewOrderPdfInvoice($order_id)
    {
        $orderDetails = Order::with('orders')->where('id', $order_id)->first();
        //dd($data['orderDetails']);
        $data['title'] = 'Order Details # ' . $orderDetails->id . '';
        $user_id = $data['orderDetails']->user_id;
        $userDetails = User::where('id', $user_id)->first();
        //dd($data['userDetails']);


        $output = '<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Example 1</title>
    <style>
        .clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #5D6975;
  text-decoration: underline;
}

body {
  position: relative;
  width: 21cm;  
  height: 29.7cm; 
  margin: 0 auto; 
  color: #001028;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 12px; 
  font-family: Arial;
}

header {
  padding: 10px 0;
  margin-bottom: 30px;
}

#logo {
  text-align: center;
  margin-bottom: 10px;
}

#logo img {
  width: 90px;
}

h1 {
  border-top: 1px solid  #5D6975;
  border-bottom: 1px solid  #5D6975;
  color: #5D6975;
  font-size: 2.4em;
  line-height: 1.4em;
  font-weight: normal;
  text-align: center;
  margin: 0 0 20px 0;
  background: url(dimension.png);
}

#project {
  float: left;
}

#project span {
  color: #5D6975;
  text-align: right;
  width: 52px;
  margin-right: 10px;
  display: inline-block;
  font-size: 0.8em;
}

#company {
  float: right;
  text-align: right;
}

#project div,
#company div {
  white-space: nowrap;        
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

table tr:nth-child(2n-1) td {
  background: #F5F5F5;
}

table th,
table td {
  text-align: center;
}

table th {
  padding: 5px 20px;
  color: #5D6975;
  border-bottom: 1px solid #C1CED9;
  white-space: nowrap;        
  font-weight: normal;
}

table .service,
table .desc {
  text-align: left;
}

table td {
  padding: 20px;
  text-align: right;
}

table td.service,
table td.desc {
  vertical-align: top;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table td.grand {
  border-top: 1px solid #5D6975;;
}

#notices .notice {
  color: #5D6975;
  font-size: 1.2em;
}

footer {
  color: #5D6975;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #C1CED9;
  padding: 8px 0;
  text-align: center;
}
</style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="assets/frontend/assets/images/dd_logo.png" alt="Daily Deals Logo">
        <!--<img src="logo.png">-->
      </div>
      <h1>INVOICE No - '.$orderDetails->id.'</h1>
      <div id="project" class="clearfix">
        <div><span>Order ID</span>'.$orderDetails->id.'</div>
        <div><span>Order Date-Time</span>'.$orderDetails->created_at.'</div>
        <div><span>Order Amount</span>'.$orderDetails->grand_total.'/-</div>
        <div><span>Order Status</span>'.$orderDetails->order_status.'</div>
        <div><span>Payment Method</span>'.$orderDetails->payment_method.'</div>
      </div>
      <div id="project" style="float: right;">
        <div><strong>Shipping Address</strong></div>
        <div>'.$orderDetails->name.'</div>
        <div>'.$orderDetails->address.','.$orderDetails->city.','.$orderDetails->zip.'</div>
        <div>'.$orderDetails->district.'</div>
        <div>'.$orderDetails->country.'</div>
        <div>'.$orderDetails->phone.'</div>
       
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
                                <th style="width: 18%"><strong>Product Code</strong></th>
                                <th style="width: 18%" class="text-center"><strong>Color</strong></th>
                                <th style="width: 18%" class="text-center"><strong>Size</strong></th>
                                <th style="width: 18%" class="text-center"><strong>Quantity</strong></th>
                                <th style="width: 18%" class="text-right"><strong>Price</strong></th>
                            </tr>
        </thead>
        <tbody>';
        $sub_total = 0;
         foreach($orderDetails->orders as $pro){
             $output.=
                 '<tr>
             <td class="service">'.$pro->product_code.'</td>
            <td class="desc">'.$pro->product_color.'</td>
            <td class="unit">'.$pro->product_size.'</td>
            <td class="qty">'.$pro->product_quantity.'</td>
            <td class="total">'.$pro->product_price * $pro->product_quantity.'/-</td>
          </tr>';
            $sub_total = $sub_total + ($pro->product_price * $pro->product_quantity);
                    }

        $output.=
            '<tr>
            <td class="service">Training</td>
            <td class="desc">Initial training sessions for staff responsible for uploading web content</td>
            <td class="unit">$40.00</td>
            <td class="qty">4</td>
            <td class="total">$160.00</td>
          </tr>
          <tr>
            <td colspan="4">SUBTOTAL</td>
            <td class="total">'.$sub_total.'/-</td>
          </tr>
          <tr>
            <td colspan="4">Shipping Charge</td>
            <td class="total">0/-</td>
          </tr>
          <tr>
            <td colspan="4" class="grand total">Discount</td>
            <td class="grand total">'.$orderDetails->coupon_amount.'/-</td>
          </tr>
          <tr>
            <td colspan="4" class="grand total">GRAND TOTAL</td>
            <td class="grand total">'.$orderDetails->grand_total.'/-</td>
          </tr>
        </tbody>
      </table>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>';

            $dompdf = new Dompdf();
            $dompdf->loadHtml($output);

            // (Optional) Setup the paper size and orientation
            $dompdf->setPaper('A4', 'landscape');

            // Render the HTML as PDF
            $dompdf->render();

            // Output the generated PDF to Browser
            $dompdf->stream();

        }




}
