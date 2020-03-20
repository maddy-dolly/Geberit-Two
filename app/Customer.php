<?php

namespace App;
use App\Country;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        '*'
    ];

    public function country(){
        return $this->hasOne('App\Country','id','countries_id');
    }

    public function countries(){
        return $this->belongsTo('App\Country','id','countries_id');
    }
    
}
