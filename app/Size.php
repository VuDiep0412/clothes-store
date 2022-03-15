<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Size extends Model
{
    //
    use SoftDeletes;
    protected $table = 'sizes';

    public function pro_size(){
        return $this->belongsTo('App\ProductSize');
    }
}
