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

    public function index()
    {
       
        return view('login');
    }

    public function loginCheck(Request $request){
<<<<<<< HEAD
        // dd($request);
        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://localhost:8000/api/login'); 
        return $response->view(['login']);
=======
      
        $email = $request->email;
        $password= Hash::make($request->password);
        $token = $request->token;
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
                $user = Auth::user();
                User::where('email', $email)
                ->update([
                'remember_token' => $token
                ]);
               
                return redirect()->intended('dashboard')
                ->withSuccess('Signed in');
            }
        
            return redirect()->route('login')->withError('Login failed');
        }
        return redirect("login")->withError('Email id doesnit exist');     
    }
>>>>>>> 6abb3aedcbadf182722739ec98622341bf66d395

    public function forgotPassword(Request $request){
         
        $email = $request->email;
        $password = $request->password;
        $c_password = $request->confirm_password;

        $this->validate($request, [
            'password' => 'required',
            'new_password' => 'confirmed|max:8|different:password',
        ]);
        
        if (Hash::check($request->password, $user->password)) { 
           $user->fill([
            'password' => Hash::make($request->new_password)
            ])->save();
        
           $request->session()->flash('success', 'Password changed');
            return redirect()->route('login');
        
        } else {
            $request->session()->flash('error', 'Password does not match');
            return redirect()->route('password');
        }
        // if(User::where('email', $email)->exists()){
        //     $result = User::where('email', $email)->update([
        //             'password' => $request->password
        //     ]);
        // }
       
    }
}
