<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Country;
use App\Usercountry;

class CustomerController extends Controller
{
   public function add(Request $request) {
    $customer = new Customer;
    $customer->name=$request->name;
    $customer->customer_code = $request->customer_code;
    $customer->currency=$request->currency;
    $customer->payment_terms = $request->payment_terms;
    $customer->countries_id = $request->countries_id;
    $customer->customer_number=$request->customer_number;
    $customer->customer_address=$request->customer_address;

    $customer->save();

    
    return response()->json(['status' => 'success'], 200);
   }

    public function showall()
    {
        $user = Customer::with('country')->get();
      
        return response()->json(
            [
                'status' => 'success',
                'user' => $user
            ], 200);
    }

    public function show(Request $request, $id)
    {
        $user = Customer::with('country')->find($id);
        return response()->json(
            [
                'status' => 'success',
                'user' => $user->toArray()
            ], 200);
    }

    public function delete($id) {
        $customer = Customer::where('id',$id)->delete();
           
        if($customer) {
        return response()->json(true);
        }
        else {
            return response()->json(false);
        }
    }

    public function deleteAll(Request $request) {
        //return response()->json($request->check_ids);
        $customer = Customer::whereIn('id',$request->users_ids)->delete();
       
              if($customer) {
              return response()->json(true);
              }
              else {
                  return response()->json(false);
              }
      }

      public function updateCustomer(Request $request,$id) {
        $customer=Customer::where('id',$id)->first();
        $customer->name=$request->name;
        $customer->customer_code = $request->customer_code;
        $customer->currency=$request->currency;
        $customer->payment_terms = $request->payment_terms;
        $customer->countries_id = $request->countries_id;
        $customer->customer_number=$request->customer_number;
        $customer->customer_address=$request->customer_address;

    $customer->save();
    return response()->json(['status' => 'success'], 200);
      }


      //
      public function addAll(Request $request) {

        $customer_info=$request->results;
        $insert = true;
        $customer = [];
        foreach($customer_info as $c){
            $new = Customer::where('name',$c["Customers Name"])->get();
            if($new->count() > 0) {
                $insert = false;
                $customer = $c;
                break;
            }
        }
        if($insert == false) {
            return response()->json(
            [
            'status' => 'error',
            'cust'=>$customer
            ], 200);
        }
        else if($insert == true) {
            foreach($customer_info as $c){
                $v=Customer::where('name',$c["Customers Name"])->get()->toArray();
                $a= Country::where('country_code',$c["Country Code"])->get()->toArray();
                $customer =new Customer;
                $customer->name=$c["Customers Name"];
                $customer->currency=$c["Currency"];
                $customer->countries_id=$a[0]["id"];
                $customer->customer_code=$c["Abbreviation"];
                $customer->customer_number=$c["Customer Number"];
                $customer->customer_address=$c["Address"];
                $customer->payment_terms=$c["Terms Of Payment"];
                $customer->save();
               
            }
            return response()->json(
                [
                'status' => 'success',
                ], 200);
        }
   
    }

    
     
}
