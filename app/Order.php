<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    public function orders(){
        return $this->hasMany('App\OrdersProduct','order_id');
    }

    public static function getOrderDetails($order_id){
        $getOrderDetails = Order::where('id',$order_id)->first();
        return $getOrderDetails;
    }

    public static function getCountryCode($country){
        $getCountryCode = Country::where('name',$country)->first();
        return $getCountryCode;
    }
}
