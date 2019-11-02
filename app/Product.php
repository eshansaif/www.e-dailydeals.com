<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Product extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'code',
        'color',
        'size',
        'description',
        'price',
        'stock',
        'status',
        'is_featured',
        'created_by',
        'updated_by',

    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function product_attributes()
    {
        return $this->hasMany('App\ProductAttribute', 'product_id', 'id');
    }

    public function product_image()
    {
        return $this->hasMany(ProductImage::class);
    }

    public static function cartCount()
    {
        if (Auth::check()) {
            $user_email = Auth::user()->email;
            $cartCount = DB::table('cart')->where('user_email', $user_email)->sum('quantity');
        } else {
            $session_id = Session::get('session_id');
            $cartCount = DB::table('cart')->where('session_id', $session_id)->sum('quantity');
        }
        return $cartCount;
    }

    public static function productCount($category_id)
    {
        $categoryCount = Product::where(['category_id' => $category_id, 'status' => 'Active'])->count();
        return $categoryCount;
    }

    public static function getProductStock($id)
    {
        $getProductStock = Product::select('stock')->where(['id' => $id])->first();
        return $getProductStock->stock;

    }

    public static function deleteCartProduct($product_id, $user_email)
    {
        DB::table('cart')->where(['product_id' => $product_id, 'user_email' => $user_email])->delete();
    }

    public static function getProductStatus($product_id){
        $getProductStatus = Product::select('status')->where('id',$product_id)->first();
        return $getProductStatus->status;
    }

    public static function getProductCount($id)
    {
        $getProductCount = Product::select('stock')->where(['id' => $id])->count();
        return $getProductCount;

    }

}