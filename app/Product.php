<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    public function productAttributes()
    {
        return $this->hasMany('App\Product', 'product_id', 'id');
    }
}

