<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Product;
use App\Quotation;
use App\Customer;

class countDataController extends Controller
{
    public function countData() {
        $data1 = Quotation::count();
        $data2 = Quotation::where('status','PENDING')->count();
        $data3 = Quotation::where('status','APPROVED')->count();
        $data4 = User::count();
        $data5 = Customer::count();
        $data6 = Product::count();
        $data7 = Quotation::where('status','DRAFTED')->count();
        return response()->json([$data1,$data2,$data3,$data4,$data5,$data6,$data7]);

    }

    public function countGraph() {
        $data['total'] = Quotation::selectRaw('COUNT(*) as count, MONTH(created_at) month')->groupBy('month')->get();
        $data['pending'] = Quotation::selectRaw('COUNT(*) as count, MONTH(created_at) month')->where('status','PENDING')->groupBy('month')->get();
        return response()->json($data);
    }
}
