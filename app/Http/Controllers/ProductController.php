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
use Maatwebsite\Excel\Facades\Excel;
use Dompdf\Dompdf;

class ProductController extends Controller
{

    public function index(Request $request)
    {
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
            'name' => 'required',
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
        $product->delete();
        session()->flash('message', 'Product is Deleted Successfully!');
        return redirect()->route('product.index');
    }

    public function restore($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();
        session()->flash('message', 'Product is Restored Successfully!');
        return redirect()->route('product.index');
    }


    public function permanent_delete($id)
    {
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
    <title>Example 2</title>
    <style>
    @font-face {
  font-family: SourceSansPro;
  src: url(SourceSansPro-Regular.ttf);
}

.clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #0087C3;
  text-decoration: none;
}

body {
  position: relative;
  width: 21cm;  
  height: 29.7cm; 
  margin: 0 auto; 
  color: #555555;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 14px; 
  font-family: SourceSansPro;
}

header {
  padding: 10px 0;
  margin-bottom: 20px;
  border-bottom: 1px solid #AAAAAA;
}

#logo {
  float: left;
  margin-top: 8px;
}

#logo img {
  height: 70px;
}

#company {
  float: right;
  text-align: right;
}


#details {
  margin-bottom: 50px;
}

#client {
  padding-left: 6px;
  border-left: 6px solid #0087C3;
  float: left;
}

#client .to {
  color: #777777;
}

h2.name {
  font-size: 1.4em;
  font-weight: normal;
  margin: 0;
}

#invoice {
  float: right;
  text-align: right;
}

#invoice h1 {
  color: #0087C3;
  font-size: 2.4em;
  line-height: 1em;
  font-weight: normal;
  margin: 0  0 10px 0;
}

#invoice .date {
  font-size: 1.1em;
  color: #777777;
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

table th,
table td {
  padding: 20px;
  background: #EEEEEE;
  text-align: center;
  border-bottom: 1px solid #FFFFFF;
}

table th {
  white-space: nowrap;        
  font-weight: normal;
}

table td {
  text-align: right;
}

table td h3{
  color: #57B223;
  font-size: 1.2em;
  font-weight: normal;
  margin: 0 0 0.2em 0;
}

table .no {
  color: #FFFFFF;
  font-size: 1.6em;
  background: #57B223;
}

table .desc {
  text-align: left;
}

table .unit {
  background: #DDDDDD;
}

table .qty {
}

table .total {
  background: #57B223;
  color: #FFFFFF;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table tbody tr:last-child td {
  border: none;
}

table tfoot td {
  padding: 10px 20px;
  background: #FFFFFF;
  border-bottom: none;
  font-size: 1.2em;
  white-space: nowrap; 
  border-top: 1px solid #AAAAAA; 
}

table tfoot tr:first-child td {
  border-top: none; 
}

table tfoot tr:last-child td {
  color: #57B223;
  font-size: 1.4em;
  border-top: 1px solid #57B223; 

}

table tfoot tr td:first-child {
  border: none;
}

#thanks{
  font-size: 2em;
  margin-bottom: 50px;
}

#notices{
  padding-left: 6px;
  border-left: 6px solid #0087C3;  
}

#notices .notice {
  font-size: 1.2em;
}

footer {
  color: #777777;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #AAAAAA;
  padding: 8px 0;
  text-align: center;
}


</style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="https://s3-eu-west-1.amazonaws.com/htmlpdfapi.production/free_html5_invoice_templates/example2/logo.png">
      </div>
      <div id="company">
        <h2 class="name">Company Name</h2>
        <div>455 Foggy Heights, AZ 85004, US</div>
        <div>(602) 519-0450</div>
        <div><a href="mailto:company@example.com">company@example.com</a></div>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">INVOICE TO:</div>
          <h2 class="name">John Doe</h2>
          <div class="address">796 Silver Harbour, TX 79273, US</div>
          <div class="email"><a href="mailto:john@example.com">john@example.com</a></div>
        </div>
        <div id="invoice">
          <h1>INVOICE 3-2-1</h1>
          <div class="date">Date of Invoice: 01/06/2014</div>
          <div class="date">Due Date: 30/06/2014</div>
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no">#</th>
            <th class="desc">DESCRIPTION</th>
            <th class="unit">UNIT PRICE</th>
            <th class="qty">QUANTITY</th>
            <th class="total">TOTAL</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="no">01</td>
            <td class="desc"><h3>Website Design</h3>Creating a recognizable design solution based on the company\'s existing visual identity</td>
            <td class="unit">$40.00</td>
            <td class="qty">30</td>
            <td class="total">$1,200.00</td>
          </tr>
          <tr>
            <td class="no">02</td>
            <td class="desc"><h3>Website Development</h3>Developing a Content Management System-based Website</td>
            <td class="unit">$40.00</td>
            <td class="qty">80</td>
            <td class="total">$3,200.00</td>
          </tr>
          <tr>
            <td class="no">03</td>
            <td class="desc"><h3>Search Engines Optimization</h3>Optimize the site for search engines (SEO)</td>
            <td class="unit">$40.00</td>
            <td class="qty">20</td>
            <td class="total">$800.00</td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">SUBTOTAL</td>
            <td>$5,200.00</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">TAX 25%</td>
            <td>$1,300.00</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">GRAND TOTAL</td>
            <td>$6,500.00</td>
          </tr>
        </tfoot>
      </table>
      <div id="thanks">Thank you!</div>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
      </div>
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
