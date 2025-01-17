<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Level;
use App\Models\Course;
use App\Models\DifficultyLevel;
use App\Models\TaskType;
use App\Models\TaskCategory;
use App\Models\Module;
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
        $updatedBy = $request->updatedBy;
        $token = $request->token;

        if($updatedBy == '1'){
            $result = DifficultyLevel::insert([
                'level_name' => $levelName,
                'mode' => $levelMode,
                'easy_task' => $easyTask,
                'medium_task' => $mediumTask,
                'difficult_task' => $difficultTask,
                'updated_by' => $updatedBy
            ]);

             if($result == true){
                return response()->json(['status' => 'true', 'message' => "Level added succesfully"]);
             }else{
                return response()->json(['status' => 'false', 'message' => "Failed to add level"]);
             }
        } else {
            return response()->json(['status' => "failed", 'message' => "Access denied"]);
        }
        
    }

    //Update level
    public function UpdateLevel(Request $request){

        $validator = Validator::make($request->all(), [
           'level_name' => 'required',
           'updatedBy' => 'required',
           'token' => 'required'
        ]);
        
        if($validator->fails()){
            return $this->sendError($validator->errors(), 'Validation Error', 422);
        }
       // $level_id = $request->id;
        $level_name = $request->level_name;
        $levelMode = $request->mode;
        $easyTask = $request->easyTask ? $request->easyTask:null;
        $mediumTask = $request->mediumTask ? $request->mediumTask:null;
        $difficultTask = $request->difficultTask ? $request->difficultTask:null;
        $updatedBy = $request->updatedBy;
        $token = $request->token;

        if($updatedBy == '1'){
            $result = DifficultyLevel::where('level_name', $level_name)->update([
                'mode' => $levelMode,
                'updated_by' => $updatedBy
            ]);

         if($result == true){
           return response()->json(['status'=> "true", 'message' => "Updated successfully"]);
         } else {
           return response()->json(['status'=> "false", 'message' => "Failed to update"]);
         }
        }
       else {
        return response()->json(['status' => "failed", 'message' => "Access denied"]);
       }
       
    }

    //Delete levels
    public function DeleteLevel(Request $request){

        $validator = Validator::make($request->all(), [
            'level_name' => 'required',
            'role_id' => 'required',
            'token' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError($validator->errors(), 'Validation Error', 422);
        }

        $level_name = $request->level_name;
        $role = $request->role_id;
        $token = $request->token;

        if($role == '1'){
            $result = DifficultyLevel::where('level_name', $level_name)->delete();

            if($result == 1){
                return response()->json(['status' => "true", 'message'=> "Deleted level successfully"]);
            } else {
                return response()->json(['status' =>"false", 'message' => "Failed to delete level"]);
            }
        } else {
            return response()->json(['status' => "failed", 'message' => "Access denied"]);
        }
    }

    //Get levels
    public function GetLevels(){
           
        $result = DifficultyLevel::select('*')->get();
        $levelResult = Level::select('*')->get();
        $course = Course::select('*')->get();
        $taskTypes = TaskType::select('*')->get();
        $taskCategory = TaskCategory::select('*')->where(['is_active' => 1])->get();
        $module = Module::select('*')->where(['is_active' => 1])->get();

        if($result == true){
            return view('assign_task', ['difficultylevel' => $result, 'level' => $levelResult, 'course' => $course, 'taskType' => $taskTypes, 'taskCategory' => $taskCategory, 'module'=> $module]);
            return response()->json(['status' => true, 'message' => "Data retreived", 'data' => $result]);
        } else {
            return response()->json(['status' => false, 'message' => "Failed to retreive data"]);
        }
    }


    // get levels for short task
    public function GetLevelsforShortAnswer(){
           
        $result = DifficultyLevel::select('*')->get();
        $levelResult = Level::select('*')->get();
        $course = Course::select('*')->get();

        if($result == true){
            return view('short_answer', ['difficultylevel' => $result, 'level' => $levelResult, 'course' => $course]);
            return response()->json(['status' => true, 'message' => "Data retreived", 'data' => $result]);
        } else {
            return response()->json(['status' => false, 'message' => "Failed to retreive data"]);
        }
    }

    //Get level by Id
    public function GetLevelbyId(Request $request){
        $validator = Validator::make($request->all(),[
            'level_id' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors(), 'Validation Error', 422);
        }
        
        $level_id = $request->level_id;

        $result = DifficultyLevel::where('id', $level_id)->first();

        if($result == true){
            return response()->json(['status' => true, 'message' => "Data retreived", 'data' => $result]);
        } else {
            return response()->json(['status' => false, 'message' => "Failed to retreive data"]);
        }

    }


    ////Difficulty level
    public function GetDifficultyLevels(){
           
        $result = Level::select('*')->get();

        if($result == true){
            return view('assign_task', ['level' => $result]);
            return response()->json(['status' => true, 'message' => "Data retreived", 'data' => $result]);
        } else {
            return response()->json(['status' => false, 'message' => "Failed to retreive data"]);
        }
    }

    //Insert difficulty level
    public function InsertDiffciultyLevel(Request $request){

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
        $updatedBy = $request->updatedBy;
        $token = $request->token;

        if($updatedBy == '1'){
            $result = Level::insert([
                'level_name' => $levelName,
                'mode' => $levelMode,
                'created_at' => date('Y-m-d'),
                'created_by' => 1
            ]);

             if($result == true){
                return response()->json(['status' => 'true', 'message' => "Level added succesfully"]);
             }else{
                return response()->json(['status' => 'false', 'message' => "Failed to add level"]);
             }
        } else {
            return response()->json(['status' => "failed", 'message' => "Access denied"]);
        }
        
    }
}
