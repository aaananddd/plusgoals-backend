<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Support\Facades\Auth; 
use Session;

class ProfileController extends Controller
{
    public function index(Request $request){

        $user = Session::get('user'); 
    
        $response = User::select('*')->where('id', $user->id)->get();
    
        // dd($response);
        return view('profile_view', ['data' => array($response)]);
   
    }
   
    public function EditProfile($id){
     
        $response = User::select('*')->where('id', $id)->get();
        // dd($response);
        return view('profile_edit', ['data' => array($response)]);

    }
    public function updateProfile(Request $request, $id)
    {   
        
        $user = Session::get('user'); 
        $id = $user->id;
 
       if(User::where('id', $id)->exists()){
        $tokenCheck = User::select('remember_token')->where('id', $id)->get();

        if(($tokenCheck[0]->remember_token) != null){

            $UserCheck = User::select('*')->where('id', $id)->first();
      
            if($UserCheck != null) {
                $first_name = $request->first_name ? $request->first_name:$UserCheck->first_name;
                $last_name = $request->last_name  ? $request->last_name:$UserCheck->last_name;
                $address1 = $request->address1  ? $request->address1:$UserCheck->address1;
                $address2 = $request->address2  ? $request->address2:$UserCheck->address2;
                $city = $request->city  ? $request->city:$UserCheck->city;
                $district = $request->district ? $request->district:$UserCheck->district;
                $state = $request->state ? $request->state:$UserCheck->state;
                $country = $request->country ? $request->country:$UserCheck->country;
                $phone = $request->phone ? $request->phone:$UserCheck->phone;
                $pincode = $request->pincode ? $request->pincode:$UserCheck->phone;
                
                
                $UpdateProfile = User::where('id', $id)->first();
                $update = User::where('id', $id)->update([
                            'first_name' => $first_name,
                            'last_name' => $last_name,
                            'address1' => $address1,
                            'address2' => $address2,
                            'city' => $city,
                            'district' => $district,
                            'state' => $state,
                            'country' => $country,
                            'phone' => $phone,
                            'pincode' => $pincode,
                            'is_active' => '1'
                    ]);
                    $response = User::select('*')->where('id', $id)->get();
                    return view('profile_view', ['data' => array($response)]);
                    
                    }else {
                        return response()->json(['status' => false, 'message' => "No such user exists"]);
                    }
        } else {
            return response()->json(['status'=>false,'message'=>'Invalid token']);
        }
       
        } else {
            return response()->json(['status'=>false, 'message'=>"No such user"]);
        }
    }
        
    public function AddUser(Request $request){
    
      $user = User::insert([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password'=> Hash::make($request->password),
            'role' => 2,
            'created_at' => date('Y-m-d'),
            'level_id'=> (int)$request->level,
            'is_active'=>1
        ]);
        // dd($user);
        if($user==true)
        {
            $teachers = User::select('*')->where('role', '2')->get();
        return view('teachers_list', ['data' => array($teachers)]);
        }
        else{
            return response()->json(['status'=>false, 'message'=>"Failed to create new user"]);
        }
    
     }
    
}
