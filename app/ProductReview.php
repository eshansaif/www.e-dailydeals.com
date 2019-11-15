<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    protected $fillable = [
        'name',
        'summary',
        'description',
        'rating',
        'product_id',

    ];
}
