<?php
namespace App\Http\Controllers;
use App\User;
use App\Usercountry;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Mail\ForgotPasswordMailable;
use App\PasswordReset;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index()
    {
       
        $users = User::with( 'role')->get();
        return response()->json(
            [
                'status' => 'success',
                'users' => $users->toArray()
            ], 200);
    }
    
    public function show(Request $request, $id)
    {
        $user = User::with('usercountry', 'role')->find($id);
        // dd($user->role->name);
        $country=array();
        $country_id =array();
        foreach($user['usercountry'] as $ucountry){
            $country[]=$ucountry->country->name;
            $country_id[] = $ucountry->country->id;
        }
        $user['country']=$country;
        $user['country_id']=$country_id;
        return response()->json(
            [
                'status' => 'success',
                'user' => $user->toArray()
            ], 200);
    }

    public function status(Request $request, $id) 
    {
        $status=User::where('id',$id)->first();
        $status->status = $request->status;
        $status->save();
        return response()->json(['status' => 'success'], 200);
    }

    public function deleteAll(Request $request) {
        //return response()->json($request->check_ids);
        $user = User::whereIn('id',$request->users_ids)->delete();
       
              if($user) {
              return response()->json(true);
              }
              else {
                  return response()->json(false);
              }
      }

      public function forgotEmailSending(Request $request) {
        $var = Str::random(32);
        $pass = new PasswordReset;
        if($check_email=User::where('email',$request->email)->first())
        {
        $pass->email = $request->email;
        $pass->token = $var;
        $pass->save();
        Mail::to($request->email)->send(new ForgotPasswordMailable($pass)) ;
        return response()->json(['status' => 'success'], 200);
        }
        else {
            return response()->json(['status' => 'error'], 201);
        }
        

      }
    public function forgotPassword(Request $request) {
        $v = Validator::make($request->all(), [
            'password'  => 'required|min:3|confirmed',
            //'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 201);
        }
        $reset_pass=PasswordReset::where('token',$request->token)->first();
        if($reset_pass){
            $user=User::where('email',$reset_pass->email)->first();
            $user->password = bcrypt($request->password);
            if($user->save()){
                PasswordReset::where('token',$request->token)->delete();
                return response()->json([
                    'status' => 'success'
                ], 201);
            }       
        }
        else {
            return response()->json([
                'status' => 'error2',
            ], 201); 
        }
        return response()->json([
            'status' => 'error3',
        ], 201);
    }  

}