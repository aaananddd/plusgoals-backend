<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
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

            return response()->json(['response_code' => false, 'message' => $msg]);
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
                
              
                    return response()->json(['status' => true, 'message'=> "Updated user details successfully"]);
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

            return response()->json(['response_code' => false, 'message' => $msg]);
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
    
            return response()->json(['response_code' => false, 'message' => $msg]);
        }
        $user_id = $request->user_id;
        $result = User::select('*')->where('id', $user_id)->delete();
        if($result == true){
            return response()->json(['status' => true, 'message' => "Deleted the user successfully"]);
        } else {
            return response()->json(['status' => false, 'message' => "Failed to delete the user or no such user exists"]);
        }
    }
     

    //Roles
    public function InsertRoles(Request $request){
        $validator = Validator::make($request->all(),[
            'role_name' => 'required',
            'created_by' => 'required'
        ]);
    
        if ($validator->fails()) {
             $msg = $validator->messages()->first();
    
            return response()->json(['response_code' => false, 'message' => $msg]);
        }
        $role_name = $request->role_name;
        $created_by = $request->created_by;
        if($created_by == 1) {
            $RoleCheck = Role::select('*')->where('role_name', $role_name)->first();
            if($RoleCheck == null){
               $role_desc = $request->role_desc;
               $is_active = 1;

            $result = Role::insert([
                'role_name' => $role_name,
                'role_description' => $role_desc,
                'is_active' => $is_active,
                'created_by' => $created_by,
                'created_at' => date('Y-m-d h:m:s')
            ]);

            if($result == true) {
                return response()->json(['status' => true, 'message' => "Role created succesfully"]);
            }else {
                return response()->json(['status' => false, 'message' => "Failed to create role"]);
            }
            }else {
                return response()->json(['status' => false, 'message' => "Role already exists"]);
            }
        }else {
            return response()->json(['status' => false, 'message' => "Access denied"]);
        }
        
    }

    //Update Roles
    public function UpdateRole(Request $request){
        $validator = Validator::make($request->all(),[
            'role_id' => 'required',
            'created_by' => 'required'
        ]);
    
        if ($validator->fails()) {
             $msg = $validator->messages()->first();
    
            return response()->json(['response_code' => false, 'message' => $msg]);
        }
        $created_by = $request->created_by;
        if($created_by == 1){
            $role_id = $request->role_id;
            $OldRole = Role::select('*')->where('role_id', $role_id)->get();
            if($OldRole != null){
  
                $OldRolename = $OldRole[0]->role_name;
                $OldRoledesc = $OldRole[0]->role_description;
                $Oldis_active = $OldRole[0]->is_active;
    
                $role_name = $request->role_name ? $request->role_name:$OldRolename;
                $role_desc =  $request->role_desc ? $request->role_desc:$OldRoledesc;
               // $is_active = $request->is_active ? $request->is_active:$Oldis_active;
    
                $result = Role::where('role_id', $role_id)->update([
                    'role_name' => $role_name,
                    'role_description' => $role_desc,
                  //  'is_active' => $is_active,
                    'created_by' => $created_by
                ]);
                if($result == true){
                    return response()->json(['status' => true, 'message' => "Updated role successfully"]);
                }else {
                    return response()->json(['status' => false, 'message' => "Failed to update role"]);
                }
            } else {
                return response()->json(['status' => false, 'message' => "No such role found"]);
            }   
        } else {
            return response()->json(['status' => false, 'message' => "Access denied"]);
        }
        
    }

    //Delete role
    public function DeleteRole(Request $request){
        $validator = Validator::make($request->all(),[
            'role_id' => 'required',
            'created_by' => 'required'
        ]);
    
        if ($validator->fails()) {
             $msg = $validator->messages()->first();
    
            return response()->json(['response_code' => false, 'message' => $msg]);
        }
        
        $created_by = $request->created_by;
        $role_id = $request->role_id;

        if($created_by == '1'){
            $result = Role::select('*')->where('role_id', $role_id)->delete();
            if($result == true){
                return response()->json(['status'=>true, 'message'=>"Role deleted successfully"]);
            } else{
                return response()->json(['status'=>false, 'message'=>"Failed to delete"]);
            }
        } else {
            return response()->json(['status'=>false, 'message'=>"Access denied"]);
        }
    }

    //Ativate and deactivate role
    public function ActivateRole(Request $request){
        $validator = Validator::make($request->all(),[
            'role_id' => 'required',
            'created_by' => 'required',
            'is_active' => 'required'
        ]);
    
        if ($validator->fails()) {
             $msg = $validator->messages()->first();
    
            return response()->json(['response_code' => false, 'message' => $msg]);
        }

        $role_id = $request->role_id;
        $created_by = $request->created_by;
        $is_active = $request->is_active;
       
        if($created_by == 1){
            $result = Role::where('role_id', $role_id)->update([ 'is_active' => $is_active]);
            $resultData = Role::select('*')->where('role_id', $role_id)->first();
            if($resultData->is_active == '1') {
                return response()->json(['status' => true, 'message' => "Role activated"]);
            } else {
                return response()->json(['status' => false, 'message' => "Role deactivated"]);
            }    
        } else {
            return response()->json(['status' => false, 'message' => "Access denied"]);
        }
        
    }
}
