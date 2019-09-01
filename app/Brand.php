<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Brand extends Model
{

    use SoftDeletes;
    protected $fillable = [
        'name',
        'details',
        'status',
        'created_by',
        'updated_by',
        'file',
    ];
}
