<?php

namespace App\Http\Controllers\API;
use App\Models\Task;
use App\Models\User;
use App\Models\Question;
use App\Models\Student;
use App\Models\StudentDetail;
use Validator;
use DB;

use Illuminate\Http\Request;

class TaskController extends Controller
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

    /// Insert Task
    public function InsertTask(Request $request){

        $validator = Validator::make($request->all(),[
            'task_name' => 'required',
            'task_desc' => 'required',
            'user_id' => 'required',
            'token' => 'required',
        ]);

        if($validator->fails()){
            $msg = $validator->messages()->first();
            return response()->json(['response_code' => false, 'message' => $msg]);
        }
        
     $user_id = $request->user_id;
     $user_access_token  = $request->token;
     $TokenCheck = User::where('id', $user_id)->first();
     $DB_token = $TokenCheck->remember_token;
     if($DB_token == $user_access_token){
        $Role_db = User::where('id', $user_id)->get('role');
        $roleCheck = $Role_db[0]->role;
        if($roleCheck == 1) { 
          $task_name = $request->task_name;
          $task_desc = $request->task_desc;
          //$created_by = $request->created_by;
          $task_level = $request->task_level ? $request->task_level:null;
          $is_active = 1;
          $NoOfQuestns = $request->NoOfQuestns ? $request->NoOfQuestns:null;
          $NofQstnsAns = $request->NofQstnsAns ? $request->NofQstnsAns:null;
          $difficulty_level = $request->difficulty_level ? $request->difficulty_level:null;
          $course_id = $request->course? $request->course:null;
          $save_template = $request->save_template ? $request->save_template:null;
          $file = $request->file ? $request->file:null;

        $result = Task::insert([
            'task_name' => $task_name,
            'task_desc' => $task_desc,
            'created_by' => $user_id,
            'task_level' => $task_level,
            'is_active' => $is_active,
            'NoOfQuestns' => $NoOfQuestns,
            'NofQstnsAns' => $NofQstnsAns,
            'difficulty_level' => $difficulty_level,
            'save_template' => $save_template,
            'course' => $course,
            'file' => $file,
            'created_date' => date('Y-m-d h:m:s')
        ]);
            if($result == true){
                
                $GetlastId = Task::select('task_id')->where('task_name', $task_name)->get();
                $task_id = $GetlastId[0]->task_id;
                for($i=0; $i<$NoOfQuestns; $i++){
                    $question[$i] = $request->question ? $request->question:null;
                }
                
                for($i=0; $i<$NoOfQuestns; $i++){
                    $QuestionSet = Question::insert([
                        'task_id' => $task_id,
                        'mode' => $difficulty_level,
                        'level_id' => $task_level,
                        'question' => $question[$i]
                    ]);
                }
            
                    // 'Question1' => $question1,
                    // 'Question2' => $question2,
                    // 'Question3' => $question3,
                    // 'Question4' => $question4,
                    // 'Question5' => $question5,
            
            
                //return redirect('/admin/dashboard')->with('success','New task has been created successfully.');
                return response()->json(['status' => true, 'message' => "Task added successfully"]);
             } else {
                return response()->json(['status' => false, ' message' => "Failed to add task"]);
             }
         } else {
             return respose()->json(['status' => false, 'message' => "Access denied"]);
         }
       } else {
          return response()->json(['status' => false, 'message' => "Invalid token"]);
      }
    }

    ///Update Task
    public function UpdateTask(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'task_name' => 'required',
            'updated_by' => 'required',
            'task_desc' => 'required',
            'token' => 'required'
        ]);

        if($validator->fails()){
            $msg = $validator->messages()->first();
            return response()->json(['response_code' => false, 'message' => $msg]);
        }
        if(Task::where('task_id', $id)->exists()){
        $user_id = $request->updated_by;
        $user_access_token  = $request->token;
        $TokenCheck = User::where('id', $user_id)->first();
        $DB_token = $TokenCheck->remember_token;                                                                  
        if($DB_token == $user_access_token){

            $Role_db = User::where('id', $user_id)->get('role');
            $roleCheck = $Role_db[0]->role;
            if($roleCheck == 1) {
                $task_name = $request->task_name;
                $TaskCheck = Task::select('*')->where('task_name', $task_name)->first();
         
                if($TaskCheck != null){
                    $task_desc = $request->task_desc ? $request->task_desc:$TaskCheck[0]->task_desc;
                    $updated_by = $request->updated_by;
                    $task_level = $request->task_level ? $request->task_level:$TaskCheck[0]->task_level;
                    $is_active = 1;
                    $time_limit = $request->time_limit ? $request->time_limit:$TaskCheck[0]->time_limit;
                    $task_date = $request->task_date ? $request->task_date:$TaskCheck[0]->task_date;
                    $difficulty_level = $request->difficulty_level ? $request->difficulty_level:$TaskCheck[0]->difficulty_level;
                    $save_template = $request->save_template ? $request->save_template:$TaskCheck[0]->save_template;
                //$token = $request->token;
    
            $result = Task::where('task_name', $task_name)->update([
                'task_name' => $task_name,
                'task_desc' => $task_desc,
                'updated_by' => $updated_by,
                'task_level' => $task_level,
                'is_active' => $is_active,
                'time_limit' => $time_limit,
                'task_date' => $task_date,
                'difficulty_level' => $difficulty_level,
                'save_template' => $save_template,
             
            ]);
    
            if($result == true){
                return response()->json(['status' => true, 'message' => "Task updated successfully"]);
            } else {
                return response()->json(['status' => false, ' message' => "Failed to update task"]);
            }
        } else{
            return response()->json(['status' => false, 'message' => "No such task found"]);
        } 
      } else {
         return response()->json(['status' => false, 'message' => "Access denied"]);
      }
    }else {
        return response()->json(['status'=>false, 'message'=>"Invalid token"]);
    }
 } else {
    return response()->json(['status'=>false, 'message' => "No such task found"]);
 }
}
    //Get tasks
    public function GetTask(){
        
        $result = Task::select('*')->get();

        if($result == true){
            return response()->json(['status' => true, 'message' => "Data retrieved", 'data' => $result]);
        } else {
            return response()->json(['status' => false, 'message' => "Failed to retreive data"]);
        }
    }

    //Get task by id
    public function GetTaskbyId($id){
       
       if(Task::where('task_id', $id)->exists()){
        $result = Task::where('task_id', $id)->first();
        
        if($result == true){
            return response()->json(['status' => true, 'message' => "Data retreived", 'data' => $result]);
        } else {
            return response()->json(['status' => false, 'message' => "Failed to retreive data"]);
        }
    }else{
        return response()->json(['status' => false, 'message' => "No such tsak found"]);
    }
}
    
    //Delete task
    public function DeleteTask(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'task_name' => 'required',
        ]);

        if($validator->fails()){
            $msg = $validator->messages()->first();
            return response()->json(['response_code' => false, 'message' => $msg]);
        }
        if(Task::where('task_id', $id)->exists()){
        $task_name = $request->task_name;

        $result = Task::where('task_name', $task_name)->delete();

        if($result == true){
            return response()->json(['status' => true, 'message'=>"Deleted task successfully"]);
        }else {
            return response()->json(['status' => false, 'message'=>"Failed to delete"]);
        }
    } else{
        return response()->json(['status' => false, 'message' => "No such task found"]);
    }
}

// Asssign tasks to students
public function assignTask(Request $request, $id){
    
    if(Student::where('id', $id)->exists()){
        $userDetails = StudentDetail::select('*')->where('student_id', $id)->get();
        $mode = $userDetails[0]->mode;
        $level = $userDetails[0]->level_id;
        $course_id = $userDetails[0]->course_id;
        $status = $userDetails[0]->level_status;
        $difficulty_level = $userDetails[0]->difficulty_level;
        $level_status = $userDetails[0]->level_status;
        $task_id = $userDetails[0]->task_id;

        if($status = "start"){
            if(($mode == "free") && ($level == 1) && ($course_id == 1)){
                $task = Task::select('*')->where(['course_id'=> $course_id, 'task_level'=>$level, 'difficulty_level'=>$difficulty_level])->first();
                $task_id = $task->task_id;
                $questions = Question::select('*')->where('task_id',$task->task_id)->get();
                
                // $updateStudentDetails = StudentDetail::where('student_id', $id)->update([
                //             'task_id' => $task_id
                // ]);
             
                return response()->json(['status'=>true, 'message'=>'Task retreived', 'tasks'=>$task, 'questions'=>$questions]);
           } else {
               return response()->json(['status' => false, 'message' => "failed to retreive"]);
           }
        }                         
        else if($status = "pending"){
            if( $mode == "free"){
                $task = Task::select('*')->where(['task_id'=>$task_id])->first();
         
                $questions = Question::select('*')->where('task_id',$task->task_id)->get();
                
                return response()->json(['status'=>true, 'message'=>'Task retreived', 'tasks'=>$task, 'questions'=>$questions]);
            } else {
                return response()->json(['status' => false, 'message' => "failed to retreive"]);
            }
           
        }
        else if($status = "failed") {
            $task = Task::select('*')->where(['course_id'=> $course_id, 'task_level'=>$level, 'difficulty_level'=>$difficulty_level])->first();
         
            $questions = Question::select('*')->where('task_id',$task->task_id)->get();
            
            return response()->json(['status'=>true, 'message'=>'Task retreived', 'tasks'=>$task, 'questions'=>$questions]);
        } 
        else if($status = "completed"){
            if( $mode == "free"){
                $task = Task::select('*')->where(['course_id'=> $course_id, 'task_level'=>$level, 'difficulty_level'=>$difficulty_level])->first();
         
                $questions = Question::select('*')->where('task_id',$task->task_id)->get();
                
                return response()->json(['status'=>true, 'message'=>'Task retreived', 'tasks'=>$task, 'questions'=>$questions]);
            } else {
                return response()->json(['status' => false, 'message' => "failed to retreive"]);
            }
    
        } else{
            return response()->json(['status' => false, 'message' => "No such user found"]);
        }
    }
}                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       

}
