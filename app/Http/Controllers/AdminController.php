<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usermaster;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //Login
    public function login(Request $request){

        $email = $request->email;
        $password = $request->password;

        $result = Usermaster::select('email', $email)->get();
        dd($result);
    }

    //Sign Up
    public function SignUp(Request $request){

        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $email = $request->email;
        $password = $request->password;
        $confirm_password = $request->confirm_password;
        $role_id = $request->role_id;
        $access_token = rand();
        
        $result = Usermaster::insert(
                   ['umUserName' => $first_name,
                    'umFirstName' => $first_name,
                    'umLastName' => $last_name,
                    'umPassword' => Hash::make($password),
                    'umUserCode' => rand(0000,9999),
                    'umGuid' => rand(00000,99999),
                    'umTS' => date('Y-m-d H:i:s'),
                    'role_id' => $role_id,
                    'access_token' => $access_token,
                    'umIsActive' => 1
                   ]);
        
        $returndata = [
            'username' => $first_name,
            'email' => $email,
            'token' => $access_token,
            'roleId' => $role_id,
            'isActive' => 1
        ];

        if($result->isEmpty()){
             return response()->json(['status' => 0, 'message' => 'Sign up failed']);
        }
        else {
            return response()->json(['status' => 1, 'message' => 'Successfully Signed up', 'data' => $returndata]);
        }
    } 

  
}
