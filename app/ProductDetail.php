<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    //
    protected $table = 'product_detail';

    public function products(){
        return $this->belongsTo('App\Product', 'product_id');
    }

    public function product_image(){
        return $this->hasMany('App\ProductImage','product_id');
    }

    public function size(){
        return $this->belongsToMany('App\Size','product_size','productDetail_id','size_id');
    }

    public function color(){
        return $this->belongsTo('App\Color','color_id','id');
    }

    public function product_size(){
        return $this->hasMany('App\ProductSize','productDetail_id','id');
    }

    public function product_color(){
        return $this->hasMany('App\ProductColor','productDetail_id','id');
    }
}
