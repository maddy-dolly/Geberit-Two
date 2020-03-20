<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name', 'display_name', 'discount', 'year_1', 'discount_1', 'year_2', 'discount_2', 'year_3', 'discount_3', 'year_4', 'discount_4',
    ];
}
