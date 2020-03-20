<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Country;
use App\ProductType;

class ProductController extends Controller
{
    public function add(Request $request) {
        $product = new Product;
        $product->material_number=$request->material_number;
        $product->product_types_id = $request->product_types_id;
        $product->description=$request->description;
        $product->list_price_usd = $request->list_price_usd;
        $product->list_price_sgd = $request->list_price_sgd;
        $product->product_line=$request->product_line;
        $product->countries_id=$request->countries_id;
        $product->material_status=$request->material_status;
        $product->st51_since=$request->st51_since;
        $product->st52_since=$request->st52_since;
        $product->sales_replaced_by=$request->sales_replaced_by;
        $product->no_sales_in=$request->no_sales_in;
        $product->quantity_pu_1=$request->quantity_pu_1;
        $product->quantity_pu_2=$request->quantity_pu_2;
        $product->quantity_pu_3=$request->quantity_pu_3;
        $product->quantity_pu_4=$request->quantity_pu_4;
        $product->net_weight=$request->net_weight;
        $product->gross_weight=$request->gross_weight;
        $product->volume_pu_1=$request->volume_pu_1;
        $product->volume_pu_2=$request->volume_pu_2;
        $product->volume_pu_3=$request->volume_pu_3;
        $product->volume_pu_4=$request->volume_pu_4;
        $product->unit_volume=$request->unit_volume;
        $product->base_unit=$request->base_unit;
        $product->weight_unit=$request->weight_unit;
        $product->step_relevant=$request->step_relevant;
        $product->product_hierarchy=$request->product_hierarchy;
        $product->pm=$request->pm;
        
        
        $product->save();
    
        
        return response()->json(['status' => 'success'], 200);
       }

       public function showall()
    {
        $product = Product::with('country','producttype')->get();
      
        return response()->json(
            [
                'status' => 'success',
                'product' => $product
            ], 200);
    }

    public function show(Request $request, $id)
    {
        $product = Product::with('country','producttype')->find($id);
        return response()->json(
            [
                'status' => 'success',
                'product' => $product->toArray()
            ], 200);
    }

    public function updateProduct(Request $request,$id) {
       
        $product=product::where('id',$id)->first();
        $product->material_number=$request->material_number;
        $product->product_types_id = $request->product_types_id;
        $product->description=$request->description;
        $product->list_price_usd = $request->list_price_usd;
        $product->list_price_sgd = $request->list_price_sgd;
        $product->product_line=$request->product_line;
        $product->countries_id=$request->countries_id;
        $product->origin_company=$request->origin_company;
        $product->material_status=$request->material_status;
        $product->st51_since=$request->st51_since;
        $product->st52_since=$request->st52_since;
        $product->sales_replaced_by=$request->sales_replaced_by;
        $product->no_sales_in=$request->no_sales_in;
        $product->quantity_pu_1=$request->quantity_pu_1;
        $product->quantity_pu_2=$request->quantity_pu_2;
        $product->quantity_pu_3=$request->quantity_pu_3;
        $product->quantity_pu_4=$request->quantity_pu_4;
        $product->net_weight=$request->net_weight;
        $product->gross_weight=$request->gross_weight;
        $product->volume_pu_1=$request->volume_pu_1;
        $product->volume_pu_2=$request->volume_pu_2;
        $product->volume_pu_3=$request->volume_pu_3;
        $product->volume_pu_4=$request->volume_pu_4;
        $product->unit_volume=$request->unit_volume;
        $product->base_unit=$request->base_unit;
        $product->weight_unit=$request->weight_unit;
        $product->step_relevant=$request->step_relevant;
        $product->product_hierarchy=$request->product_hierarchy;
        $product->pm=$request->pm;
 $product->save();
    return response()->json(['status' => 'success'], 200);
      }


      public function delete($id) {
        $product = Product::where('id',$id)->delete();
           
        if($product) {
        return response()->json(true);
        }
        else {
            return response()->json(false);
        }
    }

    public function addAll(Request $request) {

        $product_info=$request->results;
        $insert = true;
        $product = [];
        foreach($product_info as $c){
            $new = Product::where('material_number',$c["Material no."])->get();
            if($new->count() > 0) {
                $insert = false;
                $product = $c;
                break;
            }
        }
        if($insert == false) {
            return response()->json(
            [
            'status' => 'error',
            'cust'=>$product
            ], 200);
        }
        else if($insert == true) {
            foreach($product_info as $c){
                $v=Product::where('material_number',$c["Material no."])->get()->toArray();
                $a= Country::where('country_code',$c["country orig."])->get()->toArray();
                $p= ProductType::where('name',$c["Sanitary / Piping / OEM"])->get()->toArray();
                $product =new Product;
                if(isset($c["Material no."])) {                    
                    $product->material_number=$c["Material no."];
                }
                else {
                    $product->material_number='';
                }
                $product->product_types_id=$p[0]["id"];
                $product->description=$c["Description"];
                $product->list_price_usd =$c["List Price in USD"];
                $product->list_price_sgd =$c["List Price in SGD"];
                $product->product_line=$c["PL"];
                $product->countries_id=$a[0]["id"];
                $product->origin_company=$c["Origin company"];
                $product->material_status=$c["mat. status"];
                $product->st51_since=$c["st51 since"];
                // dd($c["st52 since"]);
                $product->st52_since=$c["st52 since"];
                $product->sales_replaced_by=$c["Sales replaced by"];
                if(isset($c["No sales in"])) {
                    $product->no_sales_in=$c["No sales in"];
                }
                else {
                    $product->no_sales_in='';
                }
                $product->quantity_pu_1=$c["quan. PU1"];
                $product->quantity_pu_2=$c["quan. PU2"];
                $product->quantity_pu_3=$c["quan. PU3"];
                $product->quantity_pu_4=$c["quan. PU4"];
                $product->net_weight=$c["Net weight"];
                $product->gross_weight=$c["Gross weight"];
                $product->volume_pu_1=$c["volume PU1"];
                $product->volume_pu_2=$c["volume PU2"];
                $product->volume_pu_3=$c["volume PU3"];
                $product->volume_pu_4=$c["volume PU4"];
                $product->unit_volume=$c["Unit volume"];
                $product->base_unit=$c["base unit of mea."];
                $product->weight_unit=$c["Weight unit"];
                $product->step_relevant=$c["STEP - relevant"];
                $product->product_hierarchy=$c["Product hierarchy"];
                $product->pm=$c["PM"];
                $product->save();
               
            }
            return response()->json(
                [
                'status' => 'success',
                ], 200);
        }
   
    }
    
}

           
