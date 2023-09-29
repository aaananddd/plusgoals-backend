<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Level;
use Illuminate\Support\Facades\Hash;
use Validator;

class LevelController extends Controller
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

    //Insert level
    public function InsertLevel(Request $request){

        $validator = Validator::make($request->all(), [
           'level_name' => 'required',
           'updatedBy' => 'required',
           'token' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors(), 'Validation Error', 422);
        }

        $levelName = $request->level_name;
        $levelMode = $request->mode ? $request->mode:null;
        $easyTask = $request->easyTask ? $request->easyTask:null;
        $mediumTask = $request->mediumTask ? $request->mediumTask:null;
        $difficultTask = $request->difficultTask ? $request->difficultTask:null;
        $role_id = $request->role_id;
        $token = $request->token;

        if($role_id == '1'){
            $result = Level::insert([
                'level_name' => $levelName,
                'mode' => $levelMode,
                'easy_task' => $easyTask,
                'medium_task' => $mediumTask,
                'difficult_task' => $difficultTask,
                'updated_by' => $role_id,
                'created_date' => date('Y-m-d h:m:s'),
              //  'updated_date' => date('Y-m-d h:m:s')
            ]);

             if($result == true){
                return response()->json(['status' => true, 'message' => "Level added succesfully"]);
             }else{
                return response()->json(['status' => false, 'message' => "Failed to add level"]);
             }
        } else {
            return response()->json(['status' => false , 'message' => "Access denied"]);
        }
        
    }

    //Update level
    public function UpdateLevel(Request $request, $id){

        $validator = Validator::make($request->all(), [
           'level_name' => 'required',
           'updatedBy' => 'required',
           'token' => 'required'
        ]);
        
        if($validator->fails()){
            return $this->sendError($validator->errors(), 'Validation Error', 422);
        }
        if(Level::where('id', $id)->exists()){
        $level_name = $request->level_name;
        $values = Level::where('level_name', $level_name)->get();
        $OldMode = $values[0]->mode;
        $OldEasy_task = $values[0]->easy_task;
        $OldMedium_task = $values[0]->medium_task;
        $OldDifficult_task = $values[0]->difficult_task;
       
        // $level_id = $request->id; 
        $levelMode = $request->mode ? $request->mode:$OldMode;
        $easyTask = $request->easyTask ? $request->easyTask:$OldEasy_task;
        $mediumTask = $request->mediumTask ? $request->mediumTask:$OldMedium_task;
        $difficultTask = $request->difficultTask ? $request->difficultTask:$OldDifficult_task;
        $role_id = $request->role_id;
        $token = $request->token;

        if($role_id == '1'){
            $LevelCheck = Level::select('*')->where('level_name', $level_name)->get();

            if($LevelCheck != null){
                $result = Level::where('level_name', $level_name)->update([
                    'mode' => $levelMode,
                    'easy_task' => $easyTask,
                    'medium_task' => $mediumTask,
                    'difficult_task' => $difficultTask,
                    'updated_by' => $role_id,
                  //  'updated_at' => date('Y-m-d h:m:s')
                ]);
    
             if($result == true){
               return response()->json(['status'=> true, 'message' => "Updated successfully"]);
             } else {
               return response()->json(['status'=> false, 'message' => "Failed to update"]);
             }
            } else {
                return response()->json(['status' => false, 'message'=> "No such level found"]);
            }   
        } else {
        return response()->json(['status' => false, 'message' => "Access denied"]);
       }
    } else{
        return response()->json(['status' => false, 'message' => "No such level found"]);
    }
    }

    //Delete levels
    public function DeleteLevel(Request $request, $id){

        $validator = Validator::make($request->all(), [
       //     'level_name' => 'required',
            'role_id' => 'required',
         //   'token' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError($validator->errors(), 'Validation Error', 422);
        }

        if(Level::where('id', $id)->exists()){
    //    $level_name = $request->level_name;
        $role = $request->role_id;
       // $token = $request->token;

        if($role == '1'){
                $result = Level::where('id', $id)->delete();
                if($result == true){
                    return response()->json(['status' => true, 'message'=> "Deleted level successfully"]);
                } else {
                    return response()->json(['status' => false, 'message' => "Failed to delete level"]);
                }
             } else {
                return response()->json(['status' => false, 'message' => "Access denied"]);
             }
            } else {
            return response()->json(['status' => false, 'message' => "No such level found"]);
        }
    }

    //Get levels
    public function GetLevels(){
           
        $result = Level::select('*')->get();
       
        if($result == true){
            return response()->json(['status' => true, 'message' => "Data retreived", 'data' => $result]);
        } else {
            return response()->json(['status' => false, 'message' => "Failed to retreive data"]);
        }
    }

    //Get level by Id
    public function GetLevelbyId(Request $request, $id){
        // $validator = Validator::make($request->all(),[
        //     'level_id' => 'required'
        // ]);

        // if($validator->fails()){
        //     return $this->sendError($validator->errors(), 'Validation Error', 422);
        // }
        
       //  $level_id = $request->level_id;
       if(Level::where('id', $id)->exists()){
        $result = Level::where('id', $id)->first();

        if($result == true){
            return response()->json(['status' => true, 'message' => "Data retreived", 'data' => $result]);
        } else {
            return response()->json(['status' => false, 'message' => "Failed to retreive data"]);
        }

    } else {
        return response()->json(['status' => false, 'message' => "No such found"]);
    }
 }
}