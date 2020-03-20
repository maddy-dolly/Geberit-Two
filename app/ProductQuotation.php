<?php

namespace App;
use App\Product;

use Illuminate\Database\Eloquent\Model;

class ProductQuotation extends Model
{
    public function product(){
        return $this->belongsTo('App\Product','products_id','id');
    }
    
}
