<?php

namespace App\Exports;

use App\Category;
use App\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class productsExport implements WithHeadings,FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $productsData = Product::select('category_id','name','code','color','description','price')->where('status','Active')->orderBy('id','DESC')->get();
        foreach ($productsData as $key => $product){
            $category_name = Category::select('name')->where('id',$product->category_id)->first();
            $productsData[$key]->category_id = $category_name->name;
        }
        return $productsData;

        //return Product::all();
    }

    public function headings():array {
        return['Category Name','Product Name','Product Code', 'Product Color', 'Description', 'Price'];
    }
}
