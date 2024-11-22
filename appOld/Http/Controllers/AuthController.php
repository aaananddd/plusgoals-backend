<?php


namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class AuthController extends Controller
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

    //// Signup
    public function register(Request $request) 
    {
        $input = $request->only('first_name', 'last_name', 'email', 'phone', 'password', 'c_password');

        $validator = Validator::make($input, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|min:10|max:12',
            'password' => 'required|min:6',
            'c_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return $this->sendError($validator->errors(), 'Validation Error', 422);
        }
         
        $input['password'] = bcrypt($input['password']); // use bcrypt to hash the passwords
        $user = User::create($input); // eloquent creation of data

        $success['user'] = $user;

        return $this->sendResponse($success, 'user registered successfully', 201);

    }

   /// Login
    public function login(Request $request)
    {
      
        $input = $request->only('email', 'password');

        $validator = Validator::make($input, [
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors(), 'Validation Error', 422);
        }

        try {
            // this authenticates the user details with the database and generates a token
            if (! $token = JWTAuth::attempt($input)) {
                 return redirect()->route('login')->with('success', 'Invalid login credentials');
                // return $this->sendError([], "invalid login credentials", 400);
            }
        } catch (JWTException $e) {
            
            return $this->sendError([], $e->getMessage(), 500);
        }

        $success = [
            'token' => $token,
            'email' => $request->email
        ];
  
        $result = User::where('email', $request->email)->update([
                    'remember_token' => $token
                    ]);
        
        $userDetails = User::select('*')->where('email', $request->email)->first();
        if($result == true){
          
            $user_id = $userDetails->id;
            $role = $userDetails->role;
            Session::put('user', $user_id);
            $user_detail = Session::get('user');  
            Session::put('role', $role);

            return redirect()->to('home');
            return $this->sendResponse($success, 'successful login', 200);
        } else {
             return redirect()->route('login')->with('success', 'Failed to login');
        }
        
    }

    public function getUser() 
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) {
                return $this->sendError([], "user not found", 403);
            } 
        } catch (JWTException $e) {
            return $this->sendError([], $e->getMessage(), 500);
        }

        return $this->sendResponse($user, "user data retrieved", 200);
    }

    //Refresh
    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }

    ///Logout
    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

   
}