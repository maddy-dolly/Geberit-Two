<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductType;

class ProductTypeController extends Controller
{
    public function show() {
        $product_type = ProductType::all();
        return response()->json(
            [
                'status' => 'success',
                'product_type' => $product_type->toArray()
            ], 200);
    }

}
