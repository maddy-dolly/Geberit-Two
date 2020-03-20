<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Country;
use App\ProductType;
use App\ProductQuotation;

class Product extends Model
{
    protected $fillable = [
        'material_number',
        'product_types_id',
        'description',
        'list_price_usd',
        'list_price_sgd',
        'product_line',
        'countries_id',
        'origin_company',
        'material_status',
        'st51_since',
        'st52_since',
        'sales_replaced_by',
        'no_sales_in',
        'quantity_pu_1',
        'quantity_pu_2',
        'quantity_pu_3',
        'quantity_pu_4',
        'net_weight',
        'gross_weight',
        'volume_pu_1',
        'volume_pu_2',
        'volume_pu_3',
        'volume_pu_4',
        'unit_volume',
        'base_unit',
        'weight_unit',
        'step_relevant',
        'product_hierarchy',
        'pm',
    ];

    public function country(){
        return $this->hasOne('App\Country','id','countries_id');
    }

    public function producttype(){
        return $this->hasOne('App\ProductType','id','product_types_id');
    }

    public function productquotation(){
        return $this->hasMany('App\ProductQuotation','id','quotations_id');
    }
}
