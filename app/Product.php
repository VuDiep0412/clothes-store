<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //
    use SoftDeletes;

    protected $table = 'products';

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function product_detail()
    {
        return $this->hasMany('App\ProductDetail', 'product_id');
    }

    public function product_image()
    {
        return $this->hasMany('App\ProductImage', 'product_id');
    }
    
    public function size(){
        return $this->belongsToMany('App\Size','product_size','product_id','size_id');
    }

    public function color(){
        return $this->belongsToMany('App\Color','product_color','product_id','color_id');
    }

    public function product_size(){
        return $this->hasMany('App\ProductSize','product_id','id');
    }

    public function product_color(){
        return $this->hasMany('App\ProductColor','product_id','id');
    }


    public function wishlist(){
        return $this->hasMany('App\Wishlist');
    }
    
}
