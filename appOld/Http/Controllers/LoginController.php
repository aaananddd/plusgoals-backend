<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;
use Session;
//use GuzzleHttp\Psr7\Request;

class LoginController extends Controller
{
    public function sendResponse($data, $message, $status = 200) 
    {
        $response = [
            'data' => $data,
            'message' => $message
        ];

        return response()->json($response, $status);
    }

    public function sendError($errorData, $message, $status = 500)
    {
        $response = [];
        $response['message'] = $message;
        if (!empty($errorData)) {
            $response['data'] = $errorData;
        }

        return response()->json($response, $status);
    }


    public function loginCheck(Request $request)
    {    
   
        $email = $request->email;
        $password= Hash::make($request->password);
        $token = $request->_token;
        $input = $request->only('email', 'password');
        $validator = Validator::make($input, [
             'email' => 'required',
             'password' => 'required',
        ]);
        
        if($validator->fails()){
            return $this->sendError($validator->errors(), 'Validation Error', 422);
        }
        
        if(User::where('email', $email)->exists()){
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                User::where('email', $email)
                ->update([
                'remember_token' => $token
                ]);
                // $user = Auth::user();
            $user = User::select('*')->where('email', $email)->first();
            Session::put('user', $user);
            $user_id = $user->id;
            $role = $user->role;
            Session::put('role', $role);

            return redirect()->to('home');
                //return redirect()->to('dashboard/'.$user_id);
             //   return redirect()->intended('dashboard', $user_id)->withSuccess('Signed in');
            }
        
            return redirect('/')->withError('Login failed');
        }
        return redirect("/")->withError('Email id doesnit exist');     
    }

    public function ForgotPassword(Request $request){
      
        $email = $request->email;
        $password = $request->password;
        $c_password = $request->c_password;
        
        if(User::where('email', $email)->exists()){
          
            if($password === $c_password){
          
                $result = User::where('email', $email)->update([
                    "password" => Hash::make($password)
                ]);

                if($result = true){
                    return redirect('/');
                } else {
                    return redirect('/forgot_password')->with('success','User doenot exist. Enter a registered email.');
                }
            } else {
                return redirect('/forgot_password')->with('success','Password doesnt match');
            }
        return redirect('/forgot_password');
    }
  }
}
