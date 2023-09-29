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
         
    }
}
