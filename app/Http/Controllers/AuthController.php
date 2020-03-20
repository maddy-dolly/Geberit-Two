<?php
namespace App\Http\Controllers;
use App\User;
use App\Role;
use App\Country;
use App\Usercountry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Mail\UserRegistrationMailable;
use App\PasswordReset;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
class AuthController extends Controller
{
    public function register(Request $request)
    {
        $v = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
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

        

        $role_country_err= false;
        if($request->role_id != 5) {
            $user = User::where('role_id',$request->role_id)->get();
            if($user->count() > 0) {
            foreach($user as $u) {
            $userc = UserCountry::where('user_id',$u->id)->get();
            foreach($userc as $u2) {
              $country =   explode('-',$request->countries);
            if(in_array($u2->countries_id,$country)) {
            $role_country_err = true;
            }
            }
            }
            }
            }
            if($role_country_err == true) {
                return response()->json(['status' => 'error1'], 200);
            }
            else {
                $user = new User;
                $user->saluation=$request->saluation;
                $user->name = $request->name;
                $user->abbreviation=$request->abbreviation;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->contact_number=$request->contact_number;
                $user->role_id=$request->role_id;

                if ($request->hasFile('profile_picture')) {
          
                    $image=$request->file('profile_picture');
                       $new_name=rand().'.'.$image->getClientOriginalExtension();
                       $image->move(public_path("uploads/"),$new_name); 
                       $user->profile_picture= $new_name;
                
                    }
                $user->save();
        
                $id=$user->id;
                $coun_array = explode(',', $request->countries);
                foreach($coun_array as $country_new){
                    $country = new Usercountry;
                    $country->user_id=$id;
                    $country->countries_id=$country_new;
                    $country->save(); 
                }
                $pass= $request->password;
                Mail::to($request->email)->send(new UserRegistrationMailable($user,$pass)) ;
                return response()->json(['status' => 'success'], 200);
            }
            
       // $user->profile_picture=$request->profile_picture;
     
    }

    public function update(Request $request, $id)
    {
        $v = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email,'.$id,
            //'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 201);
        }
        $country_variable = Usercountry::where('user_id',$id)->delete();
        $user =  User::where('id',$id)->first();
        $user->saluation=$request->saluation;
        $user->name = $request->name;
        $user->abbreviation=$request->abbreviation;
        $user->email = $request->email;
        if(isset($request->password)){
            $user->password = bcrypt($request->password);
        }
        $user->contact_number=$request->contact_number;
        $user->role_id=$request->role_id; 
        if ($request->hasFile('profile_picture')) {
          
            $image=$request->file('profile_picture');
               $new_name=rand().'.'.$image->getClientOriginalExtension();
               $image->move(public_path("uploads/"),$new_name); 
               $user->profile_picture= $new_name;
        
        }
        $user->save();

        $coun_array = explode(',', $request->countries);
        foreach($coun_array as $country_new){
            $country = new Usercountry;
            $country->user_id=$id;
            $country->countries_id=$country_new;
            $country->save(); 
        }
        return response()->json(['status' => 'success'], 200);
    }

    public function login(Request $request)
    {
        $data = User::where('email',$request->email)->first();
        $credentials = $request->only('email', 'password');
        if ($token = $this->guard()->attempt($credentials)) {
            return response()->json(['status' => 'success','data' => $data], 200)->header('Authorization', $token);
        }
        return response()->json(['error' => 'login_error'], 401);
    }
    public function logout()
    {
        $this->guard()->logout();
        return response()->json([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }
    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);
        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }
    public function refresh()
    {
        if ($token = $this->guard()->refresh()) {
            return response()
                ->json(['status' => 'successs'], 200)
                ->header('Authorization', $token);
        }
        return response()->json(['error' => 'refresh_token_error'], 401);
    }
    private function guard()
    {
        return Auth::guard();
    }
}