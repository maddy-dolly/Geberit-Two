<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Country;
use App\Usercountry;
use App\ProductType;
use App\Product;
use App\Quotation;
use App\ProductQuotation;
use App\Exports\QuotationExport;
use App\User;
use App\Role;
use Excel;
use PDF;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use App\Mail\QuotationAcceptMailable;
use App\Mail\QuotationCreateMailable;
use App\Mail\QuotationRejectMailable;
use App\Mail\UserRegistrationMailable;

class QuotationController extends Controller

{

    public function userCustomer($user_id)
    {
        $user_countries=Usercountry::where('user_id',$user_id)->get(['countries_id']);
        // dd($user_countries);
        $user = Customer::with('country')->whereIn('countries_id',$user_countries)->get();
        //dd($user);
        $product = Product::all();

        return response()->json(
        [
        'status' => 'success',
        'user' => $user,
        'product' => $product,
        ], 200);
    }

    public function addQuotation(Request $request) {
        // dd($request->action);
        /* $users = User::with( 'role')->get();
        $role_discount = $users[0]['role']['discount'];
        if($role_discount>=60) {
        dd('hyy');
        } */

        /*  $customer_country=Customer::where('id',21)->with("country")->first();
        $customer_country['country']->country_code;   */
        $model_ins = Quotation::orderBy('id', 'desc')->take(1)->first(['id']);
        $latest_id=$model_ins['id']+1; 
        $customer_country= $request->country_code;
        $user_abb=$request->user_id;
        $ref=$customer_country."/".$user_abb."/2000".$latest_id;

        $quotation = new quotation;
        $quotation->quotation_for=$request->quotation_for;
        $quotation->customers_id = $request->customers_id;
        $quotation->currency=$request->currency;
        $quotation->refrence_number = $ref;
        $quotation->project_name = $request->project_name;
        $quotation->remarks=$request->remarks;
        $quotation->validity=$request->validity;
        $quotation->incoterm=$request->incoterm;
        $quotation->payment=$request->payment;
        $quotation->quotation_cost=$request->quotation_cost;
        $quotation->reason=$request->reason;
        $quotation->created_by=$request->user_idd;

        $quotation->project_detail=$request->project_detail;
        $quotation->project_location=$request->project_location;
        $quotation->strategic_reason=$request->strategic_reason;
        $quotation->competition=$request->competition;
        $quotation->chance_improvement=$request->chance_improvement;
        $quotation->delivery_schedule=$request->delivery_schedule;
        $quotation->distributor_margin=$request->distributor_margin;
        if($request->action=='draft') {
            $quotation->status = 'DRAFTED';
            // dd('hyy');
        }
        else {
            $quotation->status = $request->status;
        }
        

        $quotation->save();

        $id=$quotation->id;
        $maxdiscount = 0;
        $quotation_arr = json_decode($request->quotation_array);
        foreach($quotation_arr as $quotation_new){
        $quo = new ProductQuotation;
        $quo->quotations_id=$id;
        $quo->products_id=$quotation_new->products_id;
        $quo->product_description=$quotation_new->product_description;
        $quo->quantity=$quotation_new->quantity;
        $quo->discount=$quotation_new->discount;

        if($quotation_new->discount>$maxdiscount) {
        $maxdiscount=$quotation_new->discount;
        }
        $quo->unit_price=$quotation_new->discount_price;
        $discount_unit_price = $quotation_new->discount_price*$quotation_new->discount/100;
        $quo->discount_unit_price=$discount_unit_price;
        $quo->total_cost=$quotation_new->total_price;
       $quo->save(); 
        }

        $quotation_update=Quotation::with('customer','productquotation')->where('id',$id)->first();
        $users = User::with( 'role')->get();
        $role_discount = $users[0]['role']['discount'];
        $role_check = Role::all();
        $roletoassign = [];

        if($role_discount == '') {
            // dd('Hey');
            $roletoassign = [];
            $roleslist = Role::all();
            if($maxdiscount<=65) {
            $roletoassign = [];
            $roleslist = Role::all();
            foreach($roleslist as $rl) {
            if($rl->discount != '') {
            $singleroledis = explode('-',$rl->discount);
            if($singleroledis[0] <= $maxdiscount && $singleroledis[1] >= $maxdiscount) {
            $roletoassign[] = $rl->id;
            }
            }
            }
            }
            else {
            $roletoassign = [];
            $roleslist = Role::all();
            foreach($roleslist as $rl) {
            if($rl->discount != '') {
            $singleroledis = explode('-',$rl->discount);
            // dd($singleroledis[0]);
            if($singleroledis[1] == 65) {
            $roletoassign[] = $rl->id;
            }
            }
            }
            }
            // dd($roletoassign);
            
            
            $acountry = Country::where('country_code',$request->country_code)->first();
            $acountry2 = UserCountry::where('countries_id',$acountry->id)->get();
            $uc=[];
            foreach($acountry2 as $ac2) {
            $uc[] = $ac2->user_id;
            }
            //dd($uc);
            $to_emails=[];
            $toassignlist = '';
            $auser = User::whereIn('role_id',$roletoassign)->whereIn('id',$uc)->get();
            // dd($auser);
            foreach($auser as $au) {
                $to_emails[]= $au->email;
            if($toassignlist == '') {
            $toassignlist = $au->id;
            }
           
            else {
                $toassignlist = $toassignlist.','.$au->id;
                }
                }
                 //dd($toassignlist);
                $quotation_update->assigned_to = $toassignlist;
            }
            // dd($to_emails); 
           // dd($quotation_update);
            foreach($to_emails as $to_mail) {
                // dd($to_mail);
                $user = User::with('role')->where('email',$to_mail)->first();
                //dd($quotation_update);
                
                Mail::to($user->email)->send(new QuotationCreateMailable($user,$quotation_update));
            }
     
       $quotation_update->save();
        return response()->json(['status' => 'success'], 200);
    }

    public function quotationList($id) {
        $quotation['drafted'] = Quotation::with('customer','productquotation','user', 'users')->where('status','DRAFTED')->where('deleted_at', 'true')->where('created_by', $id)->get();
        $quotation['project'] = Quotation::with('customer','productquotation','user', 'users')->where('status',"!=",'DRAFTED' )->where('deleted_at', 'true')->where('quotation_for','Project')->where(function($q) use ($id){
            $q->whereRaw("find_in_set('".$id."',assigned_to)")
            ->orWhere('created_by', $id);
        })->get(); 
        $quotation['retail'] = Quotation::with('customer','productquotation','user', 'users')->where('status',"!=",'DRAFTED' )->where('deleted_at', 'true')->where('quotation_for','Retail' )->where(function($q) use ($id){
            $q->whereRaw("find_in_set('".$id."',assigned_to)")
            ->orWhere('created_by', $id);
        })->get(); 
       
        return response()->json([
            'status' => 'success',
            'data' => $quotation
        ]); 
    }

    public function showQuotation($id,$ref_no)
    {
        $quotation = Quotation::with('customer','user','productquotation')->where('refrence_number', base64_decode($ref_no))->orderBy('id','DESC')->get();
        $quotation1 = ProductQuotation::with('product')->where('quotations_id',$id)->get();
        //$quotation1 = $quotation->where()
        return response()->json(
        [
        'status' => 'success',
        'quotation' => $quotation,
        'qp' => $quotation1
        ], 200);
    }
    public function showSingleQuotation($id)
    {
        $quotation = Quotation::query()->with('customer','user','productquotation')->find($id);
        $quotation1 = ProductQuotation::with('product')->where('quotations_id',$id)->get();
       //$quotation1 = $quotation->where()
        return response()->json(
            [
                'status' => 'success',
                'quotation' => $quotation,
                'qp' => $quotation1
            ], 200);
    }
    public function Export($id) {

        $quotation = Quotation::with('customer','user')->find($id);
        $quotation1 = ProductQuotation::with('product')->where('quotations_id',$id)->get();
        return Excel::download(new QuotationExport($quotation,$quotation1), 'products.xlsx');

    }

    public function Pdf($id) {
        $data['quotation'] = Quotation::with('customer','user')->find($id);
        $data['quotation1'] = ProductQuotation::with('product')->where('quotations_id',$id)->get();
        $pdf = PDF::loadView('exports.sales_pdf', $data); 
        return $pdf->download('sales.pdf');
    }
    public function PdfUser($id) {
        $data['quotation'] = Quotation::with('customer','user')->find($id);
        $data['quotation1'] = ProductQuotation::with('product')->where('quotations_id',$id)->get();
        $pdf = PDF::loadView('exports.user_pdf', $data); 
        return $pdf->download('user.pdf');

    }

    public function updateQuotation(Request $request,$id) {
        $status = Quotation::find($id);
        $ref = $status->refrence_number;
        if($status->status == 'DRAFTED') {
        $quotation_variable = ProductQuotation::where('quotations_id',$id)->delete();

        $quotation = Quotation::where('id',$id)->first();
        $quotation->quotation_for=$request->quotation_for;
        $quotation->customers_id = $request->customers_id;
        $quotation->currency=$request->currency;
        $quotation->project_name = $request->project_name;
        $quotation->remarks=$request->remarks;
        $quotation->refrence_number = $ref;
        $quotation->validity=$request->validity;
        $quotation->incoterm=$request->incoterm;
        $quotation->payment=$request->payment;
        $quotation->quotation_cost=$request->quotation_cost;
        $quotation->reason=$request->reason;
        $quotation->created_by=$request->user_idd;
        $quotation->project_detail=$request->project_detail;
        $quotation->project_location=$request->project_location;
        $quotation->strategic_reason=$request->strategic_reason;
        $quotation->competition=$request->competition;
        $quotation->chance_improvement=$request->chance_improvement;
        $quotation->delivery_schedule=$request->delivery_schedule;
        $quotation->distributor_margin=$request->distributor_margin;
        if($request->action=='draft') {
            $quotation->status = 'DRAFTED';
            // dd('hyy');
        }
        else {
            $quotation->status = $request->status;
        }
        

        $quotation->save();

        $id=$quotation->id;
        $maxdiscount = 0;
        $quotation_arr = json_decode($request->quotation_array);
        foreach($quotation_arr as $quotation_new){
        $quo = new ProductQuotation;
        $quo->quotations_id=$id;
        $quo->products_id=$quotation_new->products_id;
        $quo->product_description=$quotation_new->product_description;
        $quo->quantity=$quotation_new->quantity;
        $quo->discount=$quotation_new->discount;

        if($quotation_new->discount>$maxdiscount) {
        $maxdiscount=$quotation_new->discount;
        }
        $quo->unit_price=$quotation_new->discount_price;
        $discount_unit_price = $quotation_new->discount_price*$quotation_new->discount/100;
        $quo->discount_unit_price=$discount_unit_price;
        $quo->total_cost=$quotation_new->total_price;
        $quo->save(); 
        }

        $quotation_update=Quotation::where('id',$id)->first();
        $users = User::with( 'role')->get();
        $role_discount = $users[0]['role']['discount'];
        $role_check = Role::all();
        $roletoassign = [];

        if($role_discount == '') {
            // dd('Hey');
            $roletoassign = [];
            $roleslist = Role::all();
            if($maxdiscount<=65) {
            $roletoassign = [];
            $roleslist = Role::all();
            foreach($roleslist as $rl) {
            if($rl->discount != '') {
            $singleroledis = explode('-',$rl->discount);
            if($singleroledis[0] <= $maxdiscount && $singleroledis[1] >= $maxdiscount) {
            $roletoassign[] = $rl->id;
            }
            }
            }
            }
            else {
            $roletoassign = [];
            $roleslist = Role::all();
            foreach($roleslist as $rl) {
            if($rl->discount != '') {
            $singleroledis = explode('-',$rl->discount);
            // dd($singleroledis[0]);
            if($singleroledis[1] == 65) {
            $roletoassign[] = $rl->id;
            }
            }
            }
            }
            // dd($roletoassign);
            
            
            $acountry = Country::where('country_code',$request->country_code)->first();
            $acountry2 = UserCountry::where('countries_id',$acountry->id)->get();
            $uc=[];
            foreach($acountry2 as $ac2) {
            $uc[] = $ac2->user_id;
            }
            //dd($uc);
            $toassignlist = '';
            $auser = User::whereIn('role_id',$roletoassign)->whereIn('id',$uc)->get();
            //dd($auser);
            foreach($auser as $au) {
            if($toassignlist == '') {
            $toassignlist = $au->id;
            }
           
            else {
            $toassignlist = $toassignlist.','.$au->id;
            }
            }
             //dd($toassignlist);
            $quotation_update->assigned_to = $toassignlist;
            }
        $quotation_update->save(); 
        return response()->json(['status' => 'success'], 200);
        }
        else {
            $latest_revision = 0; 
            $quotation_prev = quotation::where('id',$id)->get()->toArray();
            $reference_no = $quotation_prev[0]['refrence_number'];

            //find all quotions with same reference no.
            $quotation_with_Same_ref_no=quotation::where('refrence_number',$reference_no)->get()->toArray();

                //checking for the latest revised version
                foreach($quotation_with_Same_ref_no as $q){
                if($q['revision']>$latest_revision)
                $latest_revision = $q['revision'];
                }
                $revision=$latest_revision+1;
        /* $model_ins = Quotation::orderBy('revision', 'desc')->take(1)->first(['revision']);
        // $latest_id=$model_ins['revision']+1; 
        $revision = $model_ins['revision']+1;  */
        $ref = $status->refrence_number;

        $quotation = new quotation;
        $quotation->quotation_for=$request->quotation_for;
        $quotation->customers_id = $request->customers_id;
        $quotation->currency=$request->currency;
        $quotation->project_name = $request->project_name;
        $quotation->refrence_number = $ref;
        $quotation->revision = $revision;
        $quotation->remarks=$request->remarks;
        $quotation->validity=$request->validity;
        $quotation->incoterm=$request->incoterm;
        $quotation->payment=$request->payment;
        $quotation->quotation_cost=$request->quotation_cost;
        $quotation->reason=$request->reason;
        $quotation->created_by=$request->user_idd;

        $quotation->project_detail=$request->project_detail;
        $quotation->project_location=$request->project_location;
        $quotation->strategic_reason=$request->strategic_reason;
        $quotation->competition=$request->competition;
        $quotation->chance_improvement=$request->chance_improvement;
        $quotation->delivery_schedule=$request->delivery_schedule;
        $quotation->distributor_margin=$request->distributor_margin;
        if($request->action=='draft') {
            $quotation->status = 'DRAFTED';
            // dd('hyy');
        }
        else {
            $quotation->status = $request->status;
        }
        

        $quotation->save();

        $id=$quotation->id;
        $maxdiscount = 0;
        $quotation_arr = json_decode($request->quotation_array);
        foreach($quotation_arr as $quotation_new){
        $quo = new ProductQuotation;
        $quo->quotations_id=$id;
        $quo->products_id=$quotation_new->products_id;
        $quo->product_description=$quotation_new->product_description;
        $quo->quantity=$quotation_new->quantity;
        $quo->discount=$quotation_new->discount;

        if($quotation_new->discount>$maxdiscount) {
        $maxdiscount=$quotation_new->discount;
        }
        $quo->unit_price=$quotation_new->discount_price;
        $discount_unit_price = $quotation_new->discount_price*$quotation_new->discount/100;
        $quo->discount_unit_price=$discount_unit_price;
        $quo->total_cost=$quotation_new->total_price;
        $quo->save(); 
        }

        $quotation_update=Quotation::where('id',$id)->first();
        $users = User::with( 'role')->get();
        $role_discount = $users[0]['role']['discount'];
        $role_check = Role::all();
        $roletoassign = [];

        if($role_discount == '') {
            // dd('Hey');
            $roletoassign = [];
            $roleslist = Role::all();
            if($maxdiscount<=65) {
            $roletoassign = [];
            $roleslist = Role::all();
            foreach($roleslist as $rl) {
            if($rl->discount != '') {
            $singleroledis = explode('-',$rl->discount);
            if($singleroledis[0] <= $maxdiscount && $singleroledis[1] >= $maxdiscount) {
            $roletoassign[] = $rl->id;
            }
            }
            }
            }
            else {
            $roletoassign = [];
            $roleslist = Role::all();
            foreach($roleslist as $rl) {
            if($rl->discount != '') {
            $singleroledis = explode('-',$rl->discount);
            // dd($singleroledis[0]);
            if($singleroledis[1] == 65) {
            $roletoassign[] = $rl->id;
            }
            }
            }
            }
            // dd($roletoassign);
            
            
            $acountry = Country::where('country_code',$request->country_code)->first();
            $acountry2 = UserCountry::where('countries_id',$acountry->id)->get();
            $uc=[];
            foreach($acountry2 as $ac2) {
            $uc[] = $ac2->user_id;
            }
            //dd($uc);
            $toassignlist = '';
            $auser = User::whereIn('role_id',$roletoassign)->whereIn('id',$uc)->get();
            //dd($auser);
            foreach($auser as $au) {
            if($toassignlist == '') {
            $toassignlist = $au->id;
            }
           
            else {
            $toassignlist = $toassignlist.','.$au->id;
            }
            }
             //dd($toassignlist);
            $quotation_update->assigned_to = $toassignlist;
            }
        $quotation_update->save(); 
        return response()->json(['status' => 'success'], 200);
        }
       
    }

    public function quotationSoftDelete($id) {
        // dd($id);
        $quotation = Quotation::find( $id );
        $quotation->deleted_at = 'false';
        $quotation->save(); 
    }

    public function acceptQuotation(Request $request,$id) {
            $flage = true;
            $quotation = Quotation::with('customer','productquotation')->find( $id );
            //  dd($quotation); 
            $maxdiscount = 0;
            $checkdiscount = $quotation->productquotation;
            //dd($checkdiscount);

            foreach($checkdiscount as $cd) {
                //echo '<pre>'; print_r($cd);
                if($cd->discount>$maxdiscount) {
                    $maxdiscount=$cd->discount;
                } 
            }

            if($maxdiscount<= 65) {
                if($quotation->approved_by!=''){
                    $approved = explode(',',$quotation->approved_by);
                    if(!in_array($request->approved_by,$approved)==-1){
                        $approved[]=$request->approved_by;
                    }
                }
                else{
                    $approved[]=$request->approved_by;
                }
                $quotation->approved_by=implode(",",$approved);
                $quotation->last_updated_by=$request->approved_by;
                $quotation->save(); 
                
                $approved_to = explode(',',$quotation->approved_by);
                $assigned_to = explode(',',$quotation->assigned_to);
    
                foreach($assigned_to as $assigned) {
                    if(!in_array($assigned,$approved_to)) {
                    $flage = false;
                    break;
                    }
                    }
                    // dd($flage);
            if($flage==true) {
             Quotation::where('id',$id)->update(["status" => "APPROVED"]);
             $user = User::find($quotation->created_by);
            // dd($user->role->name);
             //$quotation = Quotation::with('customer','productquotation')->find( $id );
            // dd($user);
             Mail::to($user->email)->send(new QuotationAcceptMailable($user,$quotation));
            }
            }
            else {
                if($quotation->approved_by!=''){
                    $approved = explode(',',$quotation->approved_by);
                    if(!in_array($request->approved_by,$approved)==-1){
                        $approved[]=$request->approved_by;
                    }
                }
                else{
                    $approved[]=$request->approved_by;
                }
                $quotation->approved_by=implode(",",$approved);
                $quotation->last_updated_by=$request->approved_by;
               
                $flag_65=true;
                // $approved = explode(',',$quotation->assigned_to);
                $assigned_to = explode(',',$quotation->assigned_to);
                $approved_to = explode(',',$quotation->approved_by);
                
                foreach($assigned_to as $assigned) {
                    if(!in_array($assigned,$approved_to)) {
                        $flag_65 = false;
                        break;
                    }
                }
                if($flag_65==true){
                    //dd('hello');
                    $roletoassign = '';
                    $roleslist = Role::all();
                    foreach($roleslist as $rl) {
                        if($rl->discount != '') {
                            $singleroledis = explode('-',$rl->discount);
                            // dd($singleroledis[0]);
                            if($singleroledis[1] == 100) {
                                $roletoassign = $rl->id;
                            }
                        }
                    }
                    if($roletoassign!='') {
                        $user = User::where('role_id',$roletoassign)->first();
                        if($quotation->last_updated_by!=$user->id){
                            $assigned_to[]=$user->id;
                        }
                        else{
                            $quotation->status="APPROVED";
                            $user = User::find($quotation->created_by);
                            // dd($user->role->name);
                            // $quotation = Quotation::with('customer','productquotation')->find( $id );
                           // dd($user);
                           Mail::to($user->email)->send(new QuotationAcceptMailable($user,$quotation));
                        }
                    }
                    $quotation->assigned_to=implode(",",$assigned_to);
                }
                
                $quotation->save(); 
            } 
        //$quotation = Quotation::where('id',$id)->update(["approved_by" => $request->approved_by,'last_updated_by'=> $request->approved_by,"status" => "APPROVED"]);
        return response()->json(['status' => 'success'], 200);
    }

    public function rejectQuotation(Request $request,$id) {
        
        $quotation = Quotation::where('id',$id)->update(["reason" => $request->reason,'last_updated_by'=> $request->last_updated_by,"status" => "REJECTED"]);
        $quotation_update = Quotation::with('customer','productquotation')->find( $id );
        // dd($quotation_update);
        $user = User::find($quotation_update->created_by);
        Mail::to($user->email)->send(new QuotationRejectMailable($quotation_update,$user));
        return response()->json(['status' => 'success'], 200);
    }  
    
    
}


/*  if($role_discount>=$maxdiscount) {
$quotation_update->assigned_to = $request->user_idd;
$quotation_update->approved_by = $request->user_idd;
$quotation_update->last_updated_by = $request->user_idd;
$quotation_update->status = 'APPROVED';
}
else  {
foreach($role_check as $role_check_new){
//dd($role_check_new->discount);
if($role_check_new->discount>=$maxdiscount) {
$role_id_array[] = $role_check_new->id;
} 
}         

$acountry = Country::where('country_code',$request->country_code)->first();
$acountry2 = UserCountry::where('countries_id',$acountry->id)->get();

$uc=[];
foreach($acountry2 as $ac2) {
$uc[] = $ac2->user_id;
}

$toassignlist = '';
$auser = User::whereIn('role_id',$role_id_array)->whereIn('id',$uc)->get();

foreach($auser as $au) {
if($toassignlist == '') {
$toassignlist = $au->id;
}
else {
$toassignlist = $toassignlist.','.$au->id;
}
}
$quotation_update->assigned_to = $toassignlist;
$quotation_update->status = 'PENDING';
        } */