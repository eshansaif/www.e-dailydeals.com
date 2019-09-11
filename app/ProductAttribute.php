<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $fillable = [

        'sku',
        'size',
        'price',
        'stock',
        'status',
        'created_by',
        'updated_by',

    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
