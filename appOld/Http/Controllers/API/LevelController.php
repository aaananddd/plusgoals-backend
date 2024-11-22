<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DifficultyLevel;
use App\Models\Level;
use App\Models\Course;
use App\Models\Task;
use App\Models\CourseTopic;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Validator;
use DB;

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

    //Insert Difficulty level
    public function InsertDifficultyLevel(Request $request){

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
            $result = DifficultyLevel::insert([
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

    //Update Difficulty level
    public function UpdateDifficultyLevel(Request $request, $id){

        $validator = Validator::make($request->all(), [
           'level_name' => 'required',
           'updatedBy' => 'required',
           'token' => 'required'
        ]);
        
        if($validator->fails()){
            return $this->sendError($validator->errors(), 'Validation Error', 422);
        }
        if(DifficultyLevel::where('id', $id)->exists()){
        $level_name = $request->level_name;
        $values = DifficultyLevel::where('level_name', $level_name)->get();
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
            $LevelCheck = DifficultyLevel::select('*')->where('level_name', $level_name)->get();

            if($LevelCheck != null){
                $result = DifficultyLevel::where('level_name', $level_name)->update([
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

    //Delete Difficulty levels
    public function DeleteDifficultyLevel(Request $request, $id){

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
                $result = DifficultyLevel::where('id', $id)->delete();
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

    //Get Difficulty levels
    public function GetDifficultyLevels(){
           
        $result = DifficultyLevel::select('*')->get();
       
        if($result == true){
            return response()->json(['status' => true, 'message' => "Data retreived", 'data' => $result]);
        } else {
            return response()->json(['status' => false, 'message' => "Failed to retreive data"]);
        }
    }

    //Get level by Id
    public function GetDifficultyLevelbyId(Request $request, $id){
       
       //  $level_id = $request->level_id;
       if(DifficultyLevel::where('id', $id)->exists()){
        $result = DifficultyLevel::where('id', $id)->first();

        if($result == true){
            return response()->json(['status' => true, 'message' => "Data retreived", 'data' => $result]);
        } else {
            return response()->json(['status' => false, 'message' => "Failed to retreive data"]);
        }

    } else {
        return response()->json(['status' => false, 'message' => "No such found"]);
    }
 }

 //Insert level
public function InsertLevel(Request $request){

    $levelName = $request->level_name;
    $levelMode = $request->mode ? $request->mode:null;
  
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
}

 ////Get levels
 public function GetLevels(){
           
    $result = Level::select('*')->get();

    if($result == true){
        return view('assign_task', ['level' => $result]);
        return response()->json(['status' => true, 'message' => "Data retreived", 'data' => $result]);
    } else {
        return response()->json(['status' => false, 'message' => "Failed to retreive data"]);
    }
}

//Update level
public function UpdateLevel(Request $request, $id){

    if(Level::where('id', $id)->exists()){
        $levelDetails = Level::select('*')->where('id', $id)->get();
        $Oldlevel_name = $levelDetails[0]->level_name;
        $Oldlevel_mode = $levelDetails[0]->mode;

        $level_name = $request->level_name ? $request->level_name : $Oldlevel_name;
        $level_mode = $request->mode ? $request->mode : $Oldlevel_mode;
        $result = Level::where('id', $id)->update([
            'level_name' => $level_name,
            'mode' => $level_mode,
        ]);

        if($result == true){
            return response()->json(['status'=>true, 'message'=>"Updated levels successfully"]);
        } else {
            return response()->json(['status'=>false, 'message'=>"Failed to update level"]);
        }
    }
    else {
        return response()->json(['status'=>false, 'message'=>"No such level exits"]);
    }
 }

 //Delete level
 public function DeleteLevel($id){

    if(Level::where('id', $id)->exists()){

        $result = Level::where('id', $id)->delete();
        if($result == true){
            return response()->json(['status'=>true, 'message'=>"Deleted level successfully"]);
        } else {
            return response()->json(['status'=>false, 'message'=>"Failed to delete"]);
        }
    } else {
        return response()->json(['status'=>true, 'message'=>"No such level exists"]);
    }

 }

 //Get level by id
 public function GetLevelbyId($id){

    if(Level::where('id',$id)->exists()){
        $result = Level::select('*')->where('id', $id)->get();
        
        if($result != null){
            return response()->json(['status'=>true, 'message'=>"Retreived data", 'data'=>$result]);
        } else {
            return response()->json(['status'=>false, 'message'=>"Failed to retreive data"]);
        }
    } else {
        return response()->json(['status'=>false, 'message'=>"No such level exists"]);
    }
 }

 //GET complete level details
 public function GetCompleteLevelDetails(Request $request){

    if(Student::where('remember_token', $request->token)->exists()){
        $result = Course::leftJoin('levels', 'courses.level', '=', 'levels.id')
                    ->leftJoin('course_topics', 'course_topics.course_id', '=', 'courses.id')
                    ->select('courses.id', 'levels.level_name', 'courses.course_name', 'courses.course_desc', 'levels.mode')
                    ->selectRaw('JSON_ARRAYAGG(course_topics.topics) as topics')
                    ->groupBy('courses.id', 'levels.level_name', 'courses.course_name', 'courses.course_desc', 'levels.mode')
                    ->orderBy('courses.id', 'asc')
                    ->get();
                    $courseDataArray = [];

                    foreach ($result as $row) {
                        $topics = json_decode($row->topics, true); // Decode the JSON string into an array
                    
                        $courseData = [
                            'id' => $row->id,
                            'level_name' => $row->level_name,
                            'course_name' => $row->course_name,
                            'course_desc' => $row->course_desc,
                            'mode' => $row->mode,
                            'topics' => $topics,
                        ];
                    
                        $courseDataArray[] = $courseData;
                    }
        if($result == true){
            return response()->json(['status'=>true, 'message'=>"Data retreived", 'data'=> $courseDataArray]);
        } else {
            return response()->json(['status'=>false, 'message'=>"Failed to retreive data"]);
        }
    } else {
        return response()->json(['status'=>false, 'message'=>"Invalid token"]);
    }

 }

 //Get Complete level details by id
 public function GetCompleteLevelDetailsbyID(Request $request, $id){

    if(Student::where('remember_token', $request->token)->exists()){

        
        $result = Course::leftJoin('levels', 'courses.level', '=', 'levels.id')
                        ->leftJoin('tasks', 'tasks.task_level', '=', 'levels.id')
                        ->leftjoin('difficulty_levels', 'tasks.difficulty_level','=','difficulty_levels.id')
                        ->select('courses.id', 'levels.level_name', 'courses.course_name', 'courses.course_desc', 'levels.mode')
                        ->selectRaw('COUNT(tasks.task_id) as task_count') 
                        ->groupBy('courses.id', 'levels.level_name', 'courses.course_name', 'courses.course_desc', 'levels.mode')
                        ->orderBy('courses.id', 'asc')  
                        ->get();
                        // ->get(['levels.level_name','levels.mode','courses.course_name','courses.course_desc',
                        //      'tasks.task_name','tasks.task_desc','tasks.NoOfQuestns','tasks.NofQstnsAns','difficulty_levels.level_name as difficulty']);
       
    if($result == true){
        return response()->json(['status'=>true, 'message'=>"Data retreived", 'data'=>$result]);
    } else {
        return response()->json(['status'=>false, 'message'=>"failed to retreive data"]);
    }
    } else {
        return response()->json(['status'=>false, 'message'=>"Invalid token"]);
    }
                
 }
}