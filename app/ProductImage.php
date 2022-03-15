<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    //
    protected $table = 'product_image';
    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }

    public function product_detail(){
        return $this->belongsTo('App\ProductDetail','product_id');
    }
}
