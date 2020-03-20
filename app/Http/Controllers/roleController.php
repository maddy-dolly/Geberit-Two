<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class roleController extends Controller
{
    public function addRole(Request $request) {
        $role = new Role;
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->discount = $request->discount;
        $role->year_1 = $request->year_1;
        $role->discount_1 = $request->discount_1;
        $role->year_2 = $request->year_2;
        $role->discount_2 = $request->discount_2;
        $role->year_3 = $request->year_3;
        $role->discount_3 = $request->discount_3;
        $role->year_4 = $request->year_4;
        $role->discount_4 = $request->discount_4;

        $role->save();
        return response()->json(['status' => 'success'], 200);
    }
        public function showRole() {
            $role = Role::all();
            return response()->json(
                [
                    'status' => 'success',
                    'users' => $role->toArray()
                ], 200);
        }

        public function showSingleRole($id) {
 
            $role = Role::where('id',$id)->first();
                  if($role) {
                    return response()->json(
                        [
                            'status' => 'success',
                            'users' => $role->toArray()
                        ], 200);
                  }
                  else {
                      return response()->json(false);
                  }
          }

          public function updateRole(Request $request,$id) {
            $role=Role::where('id',$id)->first();
            $role->name = $request->name;
            $role->display_name = $request->display_name;
            $role->discount = $request->discount;
            $role->year_1 = $request->year_1;
            $role->discount_1 = $request->discount_1;
            $role->year_2 = $request->year_2;
            $role->discount_2 = $request->discount_2;
            $role->year_3 = $request->year_3;
            $role->discount_3 = $request->discount_3;
            $role->year_4 = $request->year_4;
            $role->discount_4 = $request->discount_4;

        $role->save();
        return response()->json(['status' => 'success'], 200);
          }

          public function deleteRole($id) {
 
            $role = Role::where('id',$id)->delete();
           
                  if($role) {
                  return response()->json(true);
                  }
                  else {
                      return response()->json(false);
                  }
          }

          public function deleteAll(Request $request) {
            //return response()->json($request->check_ids);
            $role = Role::whereIn('id',$request->check_ids)->delete();
           
                  if($role) {
                  return response()->json(true);
                  }
                  else {
                      return response()->json(false);
                  }
          }
    
    
}
