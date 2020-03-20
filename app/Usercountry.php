<?php

namespace App;
use App\Country;
use Illuminate\Database\Eloquent\Model;

class Usercountry extends Model
{
    protected $fillable = [
        'user_id','countries_id'
    ];
    public function country(){
        return $this->hasOne('App\Country','id','countries_id');
    }

    public function customer(){
        return $this->hasOne('App\Customer','id','countries_id');
    }
}
