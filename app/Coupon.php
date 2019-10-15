<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'coupon_code',
        'amount',
        'amount_type',
        'expiry_date',
        'status',
        'created_by',
        'updated_by',
    ];
}



