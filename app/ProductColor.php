<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    //
    protected $table = 'product_color';

    public function color(){
        return $this->belongsTo('App\Color','color_id','id');
    }

    public function product_detail(){
        return $this->belongsTo('App\ProductDetail','productDetail_id','id');
    }

    public function product(){
        return $this->belongsTo('App\Product','product_id','id');
    }
}
