<?php

namespace App;
use App\Customer;
use App\ProductQuotation;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $fillable = [
        '*'
    ];
    protected $softDelete = true;


    public function customer(){
        return $this->hasOne('App\Customer','id','customers_id')->with('country');
    }

    public function user(){
        return $this->hasOne('App\User','id','created_by')->with('role');
    }

    public function users(){
        return $this->hasOne('App\User','id','last_updated_by')->with('role');
    }

        
    public function productquotation(){
        return $this->hasMany('App\ProductQuotation','quotations_id','id')->with('product');
    }

    
}
