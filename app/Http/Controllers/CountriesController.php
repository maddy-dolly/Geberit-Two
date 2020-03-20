<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Country;

class CountriesController extends Controller
{
    public function show() {
        $country = Country::all();
        return response()->json(
            [
                'status' => 'success',
                'country' => $country->toArray()
            ], 200);
    }

    
}
