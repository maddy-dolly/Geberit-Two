<?php

namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use App\User;
use App\Quotation;
use App\ProductQuotation;
use App\Usercountry;
use Excel;
use App\Exports\ProjectReportExport;
use App\Exports\ProjectPLReportExport;
use App\Exports\QuotationExport;
class ReportController extends Controller
{
    public function reportUser($id) {
        $usercountry=Usercountry::where('user_id',$id)->get(['countries_id']);
        // dd($usercountry);
        $user['country']=User::whereIn('id',Usercountry::whereIn('countries_id',$usercountry)->get(['user_id']))->get();
        $user['all'] = User::all();
// dd($user);
        return response()->json(
            [
                'status' => 'success',
                'user' => $user
            ], 200);
}
public function projectReport(Request $request, $id, $role_id) {
    // $method = $request->method();
// dd($method);

        if($role_id == 4 || $role_id == 5 || $role_id == 6 ) {
            $query = Quotation::query()->with('customer','productquotation','user', 'users')->where('status',"!=",'DRAFTED' )->where('deleted_at', 'true')->where('quotation_for','Project')->where(function($q) use ($id){
                $q->whereRaw("find_in_set('".$id."',assigned_to)")
                ->orWhere('created_by', $id);
            });
        }
        else {
            $query = Quotation::query()->with('customer','productquotation','user','users')->where('deleted_at','true')->where('quotation_for','Project');
        }

        if ($request->isMethod('post')) {
            if($request->currency != '') {
                $query = $query->where('currency', $request->currency);
            }
            if($request->user_name !='') {
              $query = $query->where(function($q) use ($request){
                    $q->whereRaw("find_in_set($request->user_name,assigned_to)")
                    ->orWhere('created_by', $request->user_name);
                });
            }
            if($request->from_date != '' || $request->to_date != '') {
                if($request->from_date != '' && $request->to_date == '') {
                    $query = $query->where('created_at','>',$request->from_date); 
                }
                if($request->from_date == '' && $request->to_date != '')  {
                    $query = $query->where('created_at','<',$request->to_date);
                }
                if($request->from_date != '' && $request->to_date != '') {
                    $query = $query->whereBetween('created_at',[$request->from_date,$request->to_date]);
                }
                // $query = $query->where('created_at',$request->from_date);
                // dd($query);
            }

        }
        $quotation = $query->get();
        
        return response()->json([
            'status' => 'success',
            'data' => $quotation
        ]); 
}
    public function retailReport(Request $request, $id, $role_id) {
        if($role_id == 4 || $role_id == 5 || $role_id == 6 ) {
            $query = Quotation::query()->with('customer','productquotation','user', 'users')->where('status',"!=",'DRAFTED' )->where('deleted_at', 'true')->where('quotation_for','Retail' )->where(function($q) use ($id){
                $q->whereRaw("find_in_set('".$id."',assigned_to)")
                ->orWhere('created_by', $id);
            });
           
        }
        else {
            $query = Quotation::query()->with('customer','productquotation','user','users')->where('deleted_at','true')->where('quotation_for','Retail');
        }
       
        if ($request->isMethod('post')) {
            if($request->currency != '') {
                $query = $query->where('currency', $request->currency);
            }
            if($request->user_name !='') {
              $query = $query->where(function($q) use ($request){
                    $q->whereRaw("find_in_set($request->user_name,assigned_to)")
                    ->orWhere('created_by', $request->user_name);
                });
            }
            if($request->from_date != '' || $request->to_date != '') {
                if($request->from_date != '' && $request->to_date == '') {
                    $query = $query->where('created_at','>',$request->from_date); 
                }
                if($request->from_date == '' && $request->to_date != '')  {
                    $query = $query->where('created_at','<',$request->to_date);
                }
                if($request->from_date != '' && $request->to_date != '') {
                    $query = $query->whereBetween('created_at',[$request->from_date,$request->to_date]);
                }
                // $query = $query->where('created_at',$request->from_date);
                // dd($query);
            }

        }
        $quotation = $query->get();
        
        return response()->json([
            'status' => 'success',
            'data' => $quotation
        ]); 
    }

    public function projectReportExport (Request $request, $id,$role_id,$user,$currency,$from,$to) {
        // dd($currency);
        if($role_id == 4 || $role_id == 5 || $role_id == 6 ) {
            $query = Quotation::query()->with('customer','productquotation','user', 'users')->where('status',"!=",'DRAFTED' )->where('deleted_at', 'true')->where('quotation_for','Project')->where(function($q) use ($id){
                $q->whereRaw("find_in_set('".$id."',assigned_to)")
                ->orWhere('created_by', $id);
            });
        }
        else {
            $query = Quotation::query()->with('customer','productquotation','user','users')->where('deleted_at','true')->where('quotation_for','Project');
        }

        if ($user != 0 || $currency == "USD" || $currency == "SGD" || $from != 0 || $to != 0) {
            if($currency == "SGD" || $currency == "USD") {
                $query = $query->where('currency', $currency);
            }
            if($user != 0) {
              $query = $query->where(function($q) use ($user){
                    $q->whereRaw("find_in_set($user,assigned_to)")
                    ->orWhere('created_by', $user);
                });
            }
            if($from != 0 || $to != 0) {
                if($from != 0 && $to == 0) {
                    $query = $query->where('created_at','>',$from); 
                }
                if($from == 0 && $to != 0)  {
                    $query = $query->where('created_at','<',$to);
                }
                if($from != 0 && $to != 0) {
                    $query = $query->whereBetween('created_at',[$from,$to]);
                }
                // $query = $query->where('created_at',$request->from_date);
                // dd($query);
            }

        }
        $quotation = $query->get();
        
        return Excel::download(new ProjectReportExport($quotation), 'project-report.xlsx');
       

    }

    public function retailReportExport (Request $request, $id,$role_id,$user,$currency,$from,$to) {
        // dd($currency);
        if($role_id == 4 || $role_id == 5 || $role_id == 6 ) {
            $query = Quotation::query()->with('customer','productquotation','user', 'users')->where('status',"!=",'DRAFTED' )->where('deleted_at', 'true')->where('quotation_for','Retail' )->where(function($q) use ($id){
                $q->whereRaw("find_in_set('".$id."',assigned_to)")
                ->orWhere('created_by', $id);
            });
           
        }
        else {
            $query = Quotation::query()->with('customer','productquotation','user','users')->where('deleted_at','true')->where('quotation_for','Retail');
        }

        if ($user != 0 || $currency == "USD" || $currency == "SGD" || $from != 0 || $to != 0) {
            if($currency == "SGD" || $currency == "USD") {
                $query = $query->where('currency', $currency);
            }
            if($user != 0) {
              $query = $query->where(function($q) use ($user){
                    $q->whereRaw("find_in_set($user,assigned_to)")
                    ->orWhere('created_by', $user);
                });
            }
            if($from != 0 || $to != 0) {
                if($from != 0 && $to == 0) {
                    $query = $query->where('created_at','>',$from); 
                }
                if($from == 0 && $to != 0)  {
                    $query = $query->where('created_at','<',$to);
                }
                if($from != 0 && $to != 0) {
                    $query = $query->whereBetween('created_at',[$from,$to]);
                }
                // $query = $query->where('created_at',$request->from_date);
                // dd($query);
            }

        }
        $quotation = $query->get();
        
        return Excel::download(new ProjectReportExport($quotation), 'user-report.xlsx');
       

    }

    public function projectPLReport(Request $request, $id, $role_id) {
        // $method = $request->method();
    // dd($method);
    
            if($role_id == 4 || $role_id == 5 || $role_id == 6 ) {
                $query = Quotation::query()->with('customer','productquotation','user', 'users')->where('status',"!=",'DRAFTED' )->where('deleted_at', 'true')->where('quotation_for','Project')->where(function($q) use ($id){
                    $q->whereRaw("find_in_set('".$id."',assigned_to)")
                    ->orWhere('created_by', $id);
                });
            }
            else {
                $query = Quotation::query()->with('customer','productquotation','user','users')->where('deleted_at','true')->where('quotation_for','Project');
            }
            // print_r($query);
            
    
            if ($request->isMethod('post')) {
                if($request->currency != '') {
                    $query = $query->where('currency', $request->currency);
                }
                if($request->user_name !='') {
                  $query = $query->where(function($q) use ($request){
                        $q->whereRaw("find_in_set($request->user_name,assigned_to)")
                        ->orWhere('created_by', $request->user_name);
                    });
                }
                if($request->from_date != '' || $request->to_date != '') {
                    if($request->from_date != '' && $request->to_date == '') {
                        $query = $query->where('created_at','>',$request->from_date); 
                    }
                    if($request->from_date == '' && $request->to_date != '')  {
                        $query = $query->where('created_at','<',$request->to_date);
                    }
                    if($request->from_date != '' && $request->to_date != '') {
                        $query = $query->whereBetween('created_at',[$request->from_date,$request->to_date]);
                    }
                    // $query = $query->where('created_at',$request->from_date);
                    // dd($query);
                }
    
            }
            $quotation = $query->get();


            $pl11 = 0;
            $pl12_oem = 0;
            $pl12 = 0;
            $pl21 = 0;
            $pl22 = 0;
            $pl31 = 0;
            $pl32 = 0;
            $pl33 = 0;
            $pl34 = 0;
            $pl35 = 0;
            $pl21_tool = 0;
            $pl22_tool = 0;

            $quotation = $quotation->filter(function($item) use($pl11,$pl12_oem,$pl12,$pl21,$pl22,$pl31,$pl32,$pl33,$pl34,$pl35,$pl21_tool,$pl22_tool) { 
            // dd($item->productquotation);
            $qnew = $item->productquotation;
            foreach($qnew as $qn) {
                switch($qn->product->product_line) {
                    case '11':
                        $pl11 = $pl11 + $qn->total_cost;
                        $item->pl11 = $pl11;
                        break;
                    case '12_oem':
                        $pl12_oem = $pl12_oem + $qn->total_cost;
                        $item->pl12_oem = $pl12_oem;
                        break;
                    case '12':
                        $pl12 = $pl12 + $qn->total_cost;
                        $item->pl12 = $pl12;
                        break;
                    case '21':
                        $pl21 = $pl21 + $qn->total_cost;
                        $item->pl21 = $pl21;
                        break;
                    case '22':
                        $pl22 = $pl22 + $qn->total_cost;
                        $item->pl22 = $pl22;
                        break;
                    case '31':
                        $pl31 = $pl31 + $qn->total_cost;
                        $item->pl31 = $pl31;
                        break;
                    case '32':
                        $pl32 = $pl32 + $qn->total_cost;
                        $item->pl32 = $pl32;
                        break;
                    case '33':
                        $pl33 = $pl33 + $qn->total_cost;
                        $item->pl33 = $pl33;
                        break;
                    case '34':
                        $pl34 = $pl34 + $qn->total_cost;
                        $item->pl34 = $pl34;
                        break;
                    case '35':
                        $pl35 = $pl35 + $qn->total_cost;
                        $item->pl35 = $pl35;
                        break;
                    case '21_tool':
                        $pl21_tool = $pl21_tool + $qn->total_cost;
                        $item->pl21_tool = $pl21_tool;
                        break;
                    case '22_tool':
                        $pl22_tool = $pl22_tool + $qn->total_cost;
                        $item->pl22_tool = $pl22_tool;
                        break;
                }
            }
            return $item;
            });
          
            return response()->json([
                'status' => 'success',
                'data' => $quotation
            ]); 
    }

    public function retailPLReport(Request $request, $id, $role_id) {
      
    
    if($role_id == 4 || $role_id == 5 || $role_id == 6 ) {
        $query = Quotation::query()->with('customer','productquotation','user', 'users')->where('status',"!=",'DRAFTED' )->where('deleted_at', 'true')->where('quotation_for','Retail' )->where(function($q) use ($id){
            $q->whereRaw("find_in_set('".$id."',assigned_to)")
            ->orWhere('created_by', $id);
        });
       
    }
    else {
        $query = Quotation::query()->with('customer','productquotation','user','users')->where('deleted_at','true')->where('quotation_for','Retail');
    }
          
            
    
            if ($request->isMethod('post')) {
                if($request->currency != '') {
                    $query = $query->where('currency', $request->currency);
                }
                if($request->user_name !='') {
                  $query = $query->where(function($q) use ($request){
                        $q->whereRaw("find_in_set($request->user_name,assigned_to)")
                        ->orWhere('created_by', $request->user_name);
                    });
                }
                if($request->from_date != '' || $request->to_date != '') {
                    if($request->from_date != '' && $request->to_date == '') {
                        $query = $query->where('created_at','>',$request->from_date); 
                    }
                    if($request->from_date == '' && $request->to_date != '')  {
                        $query = $query->where('created_at','<',$request->to_date);
                    }
                    if($request->from_date != '' && $request->to_date != '') {
                        $query = $query->whereBetween('created_at',[$request->from_date,$request->to_date]);
                    }
                    // $query = $query->where('created_at',$request->from_date);
                    // dd($query);
                }
    
            }
            $quotation = $query->get();


            $pl11 = 0;
            $pl12_oem = 0;
            $pl12 = 0;
            $pl21 = 0;
            $pl22 = 0;
            $pl31 = 0;
            $pl32 = 0;
            $pl33 = 0;
            $pl34 = 0;
            $pl35 = 0;
            $pl21_tool = 0;
            $pl22_tool = 0;

            $quotation = $quotation->filter(function($item) use($pl11,$pl12_oem,$pl12,$pl21,$pl22,$pl31,$pl32,$pl33,$pl34,$pl35,$pl21_tool,$pl22_tool) { 
            // dd($item->productquotation);
            $qnew = $item->productquotation;
            foreach($qnew as $qn) {
                switch($qn->product->product_line) {
                    case '11':
                        $pl11 = $pl11 + $qn->total_cost;
                        $item->pl11 = $pl11;
                        break;
                    case '12_oem':
                        $pl12_oem = $pl12_oem + $qn->total_cost;
                        $item->pl12_oem = $pl12_oem;
                        break;
                    case '12':
                        $pl12 = $pl12 + $qn->total_cost;
                        $item->pl12 = $pl12;
                        break;
                    case '21':
                        $pl21 = $pl21 + $qn->total_cost;
                        $item->pl21 = $pl21;
                        break;
                    case '22':
                        $pl22 = $pl22 + $qn->total_cost;
                        $item->pl22 = $pl22;
                        break;
                    case '31':
                        $pl31 = $pl31 + $qn->total_cost;
                        $item->pl31 = $pl31;
                        break;
                    case '32':
                        $pl32 = $pl32 + $qn->total_cost;
                        $item->pl32 = $pl32;
                        break;
                    case '33':
                        $pl33 = $pl33 + $qn->total_cost;
                        $item->pl33 = $pl33;
                        break;
                    case '34':
                        $pl34 = $pl34 + $qn->total_cost;
                        $item->pl34 = $pl34;
                        break;
                    case '35':
                        $pl35 = $pl35 + $qn->total_cost;
                        $item->pl35 = $pl35;
                        break;
                    case '21_tool':
                        $pl21_tool = $pl21_tool + $qn->total_cost;
                        $item->pl21_tool = $pl21_tool;
                        break;
                    case '22_tool':
                        $pl22_tool = $pl22_tool + $qn->total_cost;
                        $item->pl22_tool = $pl22_tool;
                        break;
                }
            }
            return $item;
            });
          
            return response()->json([
                'status' => 'success',
                'data' => $quotation
            ]); 
    }

    public function projectPLReportExport (Request $request, $id,$role_id,$user,$currency,$from,$to) {
        // dd($currency);
        if($role_id == 4 || $role_id == 5 || $role_id == 6 ) {
            $query = Quotation::query()->with('customer','productquotation','user', 'users')->where('status',"!=",'DRAFTED' )->where('deleted_at', 'true')->where('quotation_for','Project')->where(function($q) use ($id){
                $q->whereRaw("find_in_set('".$id."',assigned_to)")
                ->orWhere('created_by', $id);
            });
        }
        else {
            $query = Quotation::query()->with('customer','productquotation','user','users')->where('deleted_at','true')->where('quotation_for','Project');
        }

        if ($user != 0 || $currency == "USD" || $currency == "SGD" || $from != 0 || $to != 0) {
            if($currency == "SGD" || $currency == "USD") {
                $query = $query->where('currency', $currency);
            }
            if($user != 0) {
              $query = $query->where(function($q) use ($user){
                    $q->whereRaw("find_in_set($user,assigned_to)")
                    ->orWhere('created_by', $user);
                });
            }
            if($from != 0 || $to != 0) {
                if($from != 0 && $to == 0) {
                    $query = $query->where('created_at','>',$from); 
                }
                if($from == 0 && $to != 0)  {
                    $query = $query->where('created_at','<',$to);
                }
                if($from != 0 && $to != 0) {
                    $query = $query->whereBetween('created_at',[$from,$to]);
                }
                // $query = $query->where('created_at',$request->from_date);
                // dd($query);
            }

        }
        $quotation = $query->get();

        $pl11 = 0;
            $pl12_oem = 0;
            $pl12 = 0;
            $pl21 = 0;
            $pl22 = 0;
            $pl31 = 0;
            $pl32 = 0;
            $pl33 = 0;
            $pl34 = 0;
            $pl35 = 0;
            $pl21_tool = 0;
            $pl22_tool = 0;

            $quotation = $quotation->filter(function($item) use($pl11,$pl12_oem,$pl12,$pl21,$pl22,$pl31,$pl32,$pl33,$pl34,$pl35,$pl21_tool,$pl22_tool) { 
            // dd($item->productquotation);
            $qnew = $item->productquotation;
            foreach($qnew as $qn) {
                switch($qn->product->product_line) {
                    case '11':
                        $pl11 = $pl11 + $qn->total_cost;
                        $item->pl11 = $pl11;
                        break;
                    case '12_oem':
                        $pl12_oem = $pl12_oem + $qn->total_cost;
                        $item->pl12_oem = $pl12_oem;
                        break;
                    case '12':
                        $pl12 = $pl12 + $qn->total_cost;
                        $item->pl12 = $pl12;
                        break;
                    case '21':
                        $pl21 = $pl21 + $qn->total_cost;
                        $item->pl21 = $pl21;
                        break;
                    case '22':
                        $pl22 = $pl22 + $qn->total_cost;
                        $item->pl22 = $pl22;
                        break;
                    case '31':
                        $pl31 = $pl31 + $qn->total_cost;
                        $item->pl31 = $pl31;
                        break;
                    case '32':
                        $pl32 = $pl32 + $qn->total_cost;
                        $item->pl32 = $pl32;
                        break;
                    case '33':
                        $pl33 = $pl33 + $qn->total_cost;
                        $item->pl33 = $pl33;
                        break;
                    case '34':
                        $pl34 = $pl34 + $qn->total_cost;
                        $item->pl34 = $pl34;
                        break;
                    case '35':
                        $pl35 = $pl35 + $qn->total_cost;
                        $item->pl35 = $pl35;
                        break;
                    case '21_tool':
                        $pl21_tool = $pl21_tool + $qn->total_cost;
                        $item->pl21_tool = $pl21_tool;
                        break;
                    case '22_tool':
                        $pl22_tool = $pl22_tool + $qn->total_cost;
                        $item->pl22_tool = $pl22_tool;
                        break;
                }
            }
            return $item;
            });
        
        return Excel::download(new ProjectPLReportExport($quotation), 'project-pl-report.xlsx');
       

    }

    public function retailPLReportExport (Request $request, $id,$role_id,$user,$currency,$from,$to) {
        // dd($currency);
        if($role_id == 4 || $role_id == 5 || $role_id == 6 ) {
            $query = Quotation::query()->with('customer','productquotation','user', 'users')->where('status',"!=",'DRAFTED' )->where('deleted_at', 'true')->where('quotation_for','Retail' )->where(function($q) use ($id){
                $q->whereRaw("find_in_set('".$id."',assigned_to)")
                ->orWhere('created_by', $id);
            });
           
        }
        else {
            $query = Quotation::query()->with('customer','productquotation','user','users')->where('deleted_at','true')->where('quotation_for','Retail');
        }
           

        if ($user != 0 || $currency == "USD" || $currency == "SGD" || $from != 0 || $to != 0) {
            if($currency == "SGD" || $currency == "USD") {
                $query = $query->where('currency', $currency);
            }
            if($user != 0) {
              $query = $query->where(function($q) use ($user){
                    $q->whereRaw("find_in_set($user,assigned_to)")
                    ->orWhere('created_by', $user);
                });
            }
            if($from != 0 || $to != 0) {
                if($from != 0 && $to == 0) {
                    $query = $query->where('created_at','>',$from); 
                }
                if($from == 0 && $to != 0)  {
                    $query = $query->where('created_at','<',$to);
                }
                if($from != 0 && $to != 0) {
                    $query = $query->whereBetween('created_at',[$from,$to]);
                }
                // $query = $query->where('created_at',$request->from_date);
                // dd($query);
            }

        }
        $quotation = $query->get();

        $pl11 = 0;
            $pl12_oem = 0;
            $pl12 = 0;
            $pl21 = 0;
            $pl22 = 0;
            $pl31 = 0;
            $pl32 = 0;
            $pl33 = 0;
            $pl34 = 0;
            $pl35 = 0;
            $pl21_tool = 0;
            $pl22_tool = 0;

            $quotation = $quotation->filter(function($item) use($pl11,$pl12_oem,$pl12,$pl21,$pl22,$pl31,$pl32,$pl33,$pl34,$pl35,$pl21_tool,$pl22_tool) { 
            // dd($item->productquotation);
            $qnew = $item->productquotation;
            foreach($qnew as $qn) {
                switch($qn->product->product_line) {
                    case '11':
                        $pl11 = $pl11 + $qn->total_cost;
                        $item->pl11 = $pl11;
                        break;
                    case '12_oem':
                        $pl12_oem = $pl12_oem + $qn->total_cost;
                        $item->pl12_oem = $pl12_oem;
                        break;
                    case '12':
                        $pl12 = $pl12 + $qn->total_cost;
                        $item->pl12 = $pl12;
                        break;
                    case '21':
                        $pl21 = $pl21 + $qn->total_cost;
                        $item->pl21 = $pl21;
                        break;
                    case '22':
                        $pl22 = $pl22 + $qn->total_cost;
                        $item->pl22 = $pl22;
                        break;
                    case '31':
                        $pl31 = $pl31 + $qn->total_cost;
                        $item->pl31 = $pl31;
                        break;
                    case '32':
                        $pl32 = $pl32 + $qn->total_cost;
                        $item->pl32 = $pl32;
                        break;
                    case '33':
                        $pl33 = $pl33 + $qn->total_cost;
                        $item->pl33 = $pl33;
                        break;
                    case '34':
                        $pl34 = $pl34 + $qn->total_cost;
                        $item->pl34 = $pl34;
                        break;
                    case '35':
                        $pl35 = $pl35 + $qn->total_cost;
                        $item->pl35 = $pl35;
                        break;
                    case '21_tool':
                        $pl21_tool = $pl21_tool + $qn->total_cost;
                        $item->pl21_tool = $pl21_tool;
                        break;
                    case '22_tool':
                        $pl22_tool = $pl22_tool + $qn->total_cost;
                        $item->pl22_tool = $pl22_tool;
                        break;
                }
            }
            return $item;
            });
        
        return Excel::download(new ProjectPLReportExport($quotation), 'retail-pl-report.xlsx');
       

    }


   
}

/* public function reportProjectFilter(Request $request, $id) {
    $query = Quotation::query()->with('customer','productquotation','user','users')->where('deleted_at','true')->where('quotation_for','Project');
    $query_two = Quotation::quey()->with('customer','productquotation','user', 'users')->where('status',"!=",'DRAFTED' )->where('deleted_at', 'true')->where('quotation_for','Project')->where(function($q) use ($id){
        $q->whereRaw("find_in_set('".$id."',assigned_to)")
        ->orWhere('created_by', $id);
    })->get();
    if($request->currency != '') {
        $query = $query->where('currency', $request->currency);
    }
    $quotation = $query->get();
    return response()->json([
        'data' => $quotation,
    ]);
} */