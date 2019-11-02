<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'parent_id',
        'name',
        'url',
        'status',
        'created_by',
        'updated_by',
    ];

    Public function categories()
    {
        return $this->hasMany('App\Category','parent_id');
    }

    public function SubCategory()
    {
        return $this->hasMany('App\SubCategory', 'category_id', 'id');
    }

    public function Product()
    {
        return $this->hasMany('App\Product', 'category_id', 'id');
    }

    /*public static function allCategories()
    {
        $allCategories = Category::with('categories')->where(['parent_id'=>0, 'status'=>'Active'])->get();

        return $allCategories;
    }*/



}


