<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    //
    protected $table = 'product_size';

    public function size(){
        return $this->belongsTo('App\Size', 'size_id','id');
    }

    public function product_detail(){
        return $this->belongsTo('App\ProductDetail', 'productDetail_id','id');
    }

    public function product(){
        return $this->belongsTo('App\Product','product_id','id');
    }
}
