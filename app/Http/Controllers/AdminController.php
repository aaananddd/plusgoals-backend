<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Support\Facades\Auth; 

class AdminController extends Controller
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

    // Update User details
    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'address1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'pincode' => 'required'
        ]);

        if ($validator->fails()) {
            $msg = $validator->messages()->first();

            return response()->json(['response_code' => 0, 'message' => $msg]);
        }

        $user_id = $request->user_id;

        $UserCheck = User::select('*')->where('id', $user_id)->first();

        if($UserCheck != null) {
            $first_name = $request->first_name ? $request->first_name:$UserCheck[0]->first_name;
            $last_name = $request->last_name  ? $request->last_name:$UserCheck[0]->last_name;
            $address1 = $request->address1  ? $request->address1:$UserCheck[0]->address1;
            $address2 = $request->address2  ? $request->address2:$UserCheck[0]->address2;
            $city = $request->city  ? $request->city:$UserCheck[0]->city;
            $district = $request->district ? $request->district:$UserCheck[0]->district;
            $state = $request->state ? $request->state:$UserCheck[0]->state;
            $country = $request->country ? $request->country:$UserCheck[0]->country;
            $phone = $request->phone ? $request->phone:$UserCheck[0]->phone;
            $pincode = $request->pincode ? $request->pincode:$UserCheck[0]->phone;
            $user_access_token  = $request->token;
            
            $UpdateProfile = User::where('id', $user_id)->first();
            $update = User::where('id', $user_id)->update([
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
                
              
                    return response()->json(['status' => 1, 'message'=> "Updated user details successfully"]);
                }else {
                    return response()->json(['status' => false, 'message' => "No such user exists"]);
                }
        }
        
     // Get users list
     public function GetUsers(){

         $result = User::select('*')->get();

         if($result == true){
            return response()->json(['status' => true, 'message' => "Data retreived successfully", 'data' => $result]);
         } else {
            return response()->json(['status' => false, 'message' => "Failed to retreive data"]);
         }
     }  

     /// Get user by Id
     public function GetUserbyId(Request $request){

        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            $msg = $validator->messages()->first();

            return response()->json(['response_code' => 0, 'message' => $msg]);
        }

        $user_id = $request->user_id;
        $result = User::select('*')->where('id', $user_id)->first();
        if($result == true){
            return response()->json(['status' => true, 'message' => "Data retreived successfully", 'data' => $result]);
        }else {
            return response()->json(['status' => false, 'message' => "Failed to retreive data"]);
        }
     }
        //Delete a user
     public function DeleteUser(Request $request){
        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
        ]);
    
        if ($validator->fails()) {
             $msg = $validator->messages()->first();
    
            return response()->json(['response_code' => 0, 'message' => $msg]);
        }
        $user_id = $request->user_id;
        $result = User::select('*')->where('id', $user_id)->delete();
        if($result == true){
            return response()->json(['status' => true, 'message' => "Deleted the user successfully"]);
        } else {
            return response()->json(['status' => false, 'message' => "Failed to delete the user or no such user exists"]);
        }
    }
     
}
