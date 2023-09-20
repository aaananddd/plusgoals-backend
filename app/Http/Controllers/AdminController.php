<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Support\Facades\Auth; 

class AdminController extends Controller
{

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
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $address1 = $request->address1;
        $address2 = $request->address2;
        $city = $request->city;
        $district = $request->district;
        $state = $request->state;
        $country = $request->country;
        $phone = $request->phone;
        $user_access_token  = $request->token ? $request->token : null;
       
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
                    'phone' => $phone
            ]);
            
          
                return response()->json(['status' => 1, 'message'=> "Updated user details successfully"]);
            }
       
}
