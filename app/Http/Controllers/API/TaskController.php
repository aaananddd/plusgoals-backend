<?php

namespace App\Http\Controllers\API;
use App\Models\Task;
use App\Models\User;
use App\Models\Question;
use App\Models\Student;
use App\Models\Course;
use App\Models\StudentTask;
use App\Models\Level;
use App\Models\DifficultyLevel;
use App\Models\TaskAttachment;
use App\Models\StudentDetail;
use App\Models\AdminTaskAttachment;
use App\Models\TaskType;
use App\Models\ReattemptTask;
use App\Models\ManualCorrection;
use App\Models\Order;
use Validator;
use DB;
use Illuminate\Support\Arr;

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

     //Add task types (Admin Panel)
     public function addTaskType(Request $request){

        $type = $request->type;
        $result = TaskType::insert([
            'type' => $type,
            'created_at' => date('Y-m-d')
        ]);

        if($result == true){

            $data = [
                'task_type' =>$type,
                'created_date' => date('y-m-d')
            ];
            return response()->json(['status'=>true, 'message'=>"Added task type", 'data' => $data], 200);
        } else {
            return response()->json(['status'=>false, 'message'=>"failed to add task type"], 200);
        }
    }

    //Remove task type
    public function removeTaskType($id){
        
        $type = TaskType::select('type')->where('id', $id)->first();
        $result = TaskType::where('id', $id)->delete();
        if($result == true){
            return response()->json(['status'=>true, 'message'=>"Removed task type", 'task type' => $type->type], 200);
        } else {
            return response()->json(['status'=>false, 'message'=>"Failed to remove task type"], 200);
        }
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
          $time = $request->time ? $request->time:null;

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
            'course' => 1,
            'file' => $file,
            'time' => $time,
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
                    $time = $request->time ? $request->time:$TaskCheck[0]->time;
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
                'time' => $time
             
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

// Assign tasks to students
public function assignTask(Request $request, $id){
    
    if(Student::where('id', $id)->exists()){
        $userDetails = StudentDetail::select('*')->where('student_id', $id)->get();
        $mode = $userDetails[0]->mode;
        $level = $userDetails[0]->level_id;
        $course_id = $userDetails[0]->course_id;
        $status = $userDetails[0]->level_status;
        $difficulty_level = $userDetails[0]->difficulty_level;
     //   $level_status = $userDetails[0]->level_status;
        $task_id = $userDetails[0]->task_id;

        if($status == "start"){
            if(($mode == "free") && ($level == 1) && ($course_id == 1)){
                $task = Task::select('*')->where(['course_id'=> $course_id, 'task_level'=>$level, 'difficulty_level'=>$difficulty_level])->first();
                $task_id = $task->task_id;
                $questions = Question::select('*')->where('task_id',$task->task_id)->get();
             
                return response()->json(['status'=>true, 'message'=>'Task retreived', 'tasks'=>$task, 'questions'=>$questions]);
           } else {
               return response()->json(['status' => false, 'message' => "failed to retreive"]);
           }
        }                         
        else if($status == "pending"){
            if( $mode == "free"){
                $task = Task::select('*')->where(['task_id'=>$task_id])->first();
         
                $questions = Question::select('*')->where('task_id',$task->task_id)->get();
                
                return response()->json(['status'=>true, 'message'=>'Task retreived', 'tasks'=>$task, 'questions'=>$questions]);
            } else {
                return response()->json(['status' => false, 'message' => "failed to retreive"]);
            }
           
        }
        else if($status == "failed") {
        
            $task = Task::select('*')->where(['course_id'=> $course_id, 'task_level'=>$level, 'difficulty_level'=>$difficulty_level])->get();
            
            //$task_count = count($task);
            for($i = 0; $i < count($task); $i++){
            
                $questions[$i] = Question::select('*')->where('task_id',$task[$i]->task_id)->get();
                
            }
            
            return response()->json(['status'=>true, 'message'=>'Task retreived', 'tasks'=>$task, 'questions'=>$questions]);
        } 
        else if($status == "completed"){
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

public function tasklist(Request $request, $student_id)
{
    $level_id = $request->level_id;
    $user_access_token = $request->token;
    
    // Validate token
    $TokenCheck = Student::where('id', $student_id)->first();
    $DB_token = json_decode($TokenCheck->remember_token, true);
    
    if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {
        // Fetch levels and difficulty details up to and including the given level_id
        
    // $level = StudentDetail::leftjoin('levels','student_details.level_id','=','levels.id')
    //                         ->leftjoin('difficulty_levels', 'student_details.difficulty_level','=','difficulty_levels.id')
    //                         ->where(['student_details.student_id'=> $student_id, 'student_details.level_id'=> $level_id])
    //                         ->select('levels.id','levels.level_name', 'student_details.level_status','difficulty_levels.id as difficulty_id','difficulty_levels.level_name as difficulty_level') 
    //                         ->distinct()
    //                         ->get();

   $levels = Level::leftJoin('student_tasks', 'student_tasks.level_id', '=', 'levels.id')
    ->leftJoin('student_details', 'student_details.level_id', '=', 'levels.id')
  //  ->leftJoin('difficulty_levels', 'student_details.difficulty_level', '=', 'difficulty_levels.id')
    ->select(
        'levels.id',
        'levels.level_name',
        'student_tasks.task_status',
        'student_tasks.difficulty_id',
       // 'difficulty_levels.id as difficulty_id',
       // 'difficulty_levels.level_name as difficulty_level'
    )
    ->where('student_tasks.student_id', $student_id)
    ->where('levels.id', '<=', $level_id)
    ->distinct()
    ->get();
   
        $result = [];
        if ($level_id > 0) {
            foreach ($levels as $key => $lvl) {
                $result[$key]['level_id'] = $lvl->id;
                $result[$key]['level_name'] = $lvl->level_name;
                $result[$key]['difficulty_level'] = $lvl->difficulty_level;
                $result[$key]['difficulty_id'] = $lvl->difficulty_id;
                $result[$key]['task_status'] = $lvl->task_status;

                // Fetch tasks for the current level
                $tasks = StudentTask::leftJoin('tasks', 'student_tasks.task_id', '=', 'tasks.task_id')
                    ->select('tasks.task_id', 'tasks.task_name', 'tasks.time as total_time', 'student_tasks.is_completed', 'student_tasks.time_taken as timetaken', 'student_tasks.start_date', 'student_tasks.task_completion as status', 'tasks.order') 
                    ->where('student_tasks.level_id', $lvl->id)
                    ->where('student_tasks.student_id', $student_id)
                    ->get(); 

                foreach ($tasks as $task) {
                    $attemptCount = ReattemptTask::where([
                        'intern_id' => $student_id,
                        'task_id' => $task->task_id
                    ])->count();

                    if ($task->order == 1 || $task->order === null) {
                        $task->reattempt = ($attemptCount < 10);
                    } elseif ($task->order == 2) {
                        $task->reattempt = ($attemptCount < 3);
                    } else {
                        $task->reattempt = false;
                    }
                }

                $result[$key]['tasks'] = $tasks;

                // Calculate progress for this level
                $levelCount = DifficultyLevel::where('id', $lvl->difficulty_id)->sum('no_of_questions'); 
                $taskCount = StudentTask::where([
                    'student_id' => $student_id,
                    'level_id' => $lvl->id
                ])->count();
                $count = $taskCount;
                $percent = ($levelCount > 0) ? (($count / $levelCount) * 100) : 0;
                $result[$key]['progress'] = $percent;
            }
            if($result != null){
            return response()->json(['status' => true, 'message' => "Data retrieved", 'data' => $result]);
           } else {
             $level = StudentDetail::leftjoin('levels','student_details.level_id','=','levels.id')
                                ->leftjoin('difficulty_levels', 'student_details.difficulty_level','=','difficulty_levels.id')
                                ->where(['student_details.student_id'=> $student_id, 'student_details.level_id'=> $level_id])
                                ->select('levels.id','levels.level_name', 'student_details.level_status','difficulty_levels.id as difficulty_id','difficulty_levels.level_name as difficulty_level') 
                                ->distinct()
                                ->first();
	  $level['tasks'] = [];
	   
            return response()->json(['status'=>true, 'message'=>"No tasks found", 'data'=>array($level)]);
           }
        } else {
            return response()->json(['status' => false, 'message' => "No levels found"]);
        }
    } else {
        return response()->json(['status' => false, 'message' => "Invalid token"]);
    }
}
 
 //Attempt tasks
public function taskAttempt(Request $request, $student_id){
    $task_id = $request->task_id;
   
    if(Student::where('id', $student_id)->exists()){
	$user_access_token  = $request->token;
        $TokenCheck = Student::where('id', $student_id)->first();
        $DB_token = json_decode($TokenCheck->remember_token, true);
     
        if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {
       // $token = $request->token;
       // $userToken = Student::select('remember_token')->where('id', $student_id)->get();
       // if($token == $userToken[0]->remember_token){
            $taskDetails = Task::select('course_id','task_level', 'difficulty_level')->where('task_id', $task_id)->get();
            $course_id = $taskDetails[0]->course_id;
            $level_id = $taskDetails[0]->task_level;
            $difficulty = $taskDetails[0]->difficulty_level;
            $courseDetails = Course::select('mode')->where('id', $course_id)->get();
            $mode = $courseDetails[0]->mode;
            $studentDetail = StudentDetail::where('student_id', $student_id)
                                        ->update([
                                            'student_id' => $student_id,
                                            'task_id' => $task_id,
                                            'course_id' => $course_id,
                                            'level_status' => "Pending",
                                            'difficulty_level' => $difficulty,
                                            'level_id' => $level_id,
                                            'mode' => $mode
            ]);
               if(StudentTask::where(['student_id' => $student_id, 'task_id'=> $task_id])->exists()){
                $studentTask = StudentTask::where(['student_id' => $student_id, 'task_id' => $task_id])->update([
                    
                    'is_completed' => '0',
                  //  'time_taken' => $duration,
                  //  'start_date' => $start_date,
                  //  'end_date' => $end_date,
                    'level_id' => $level_id,
                    'difficulty_id' => $difficulty,
                    'task_status' => "Pending",
                    'created_at' => date('Y-m-d')
                ]); 
            } else {
                $studentTask = StudentTask::insert([
                    'student_id' => $student_id,
                    'task_id' => $task_id,
                    'is_completed' => '0',
                  //  'time_taken' => $duration,
                  //  'start_date' => $start_date,
                  //  'end_date' => $end_date,
                    'level_id' => $level_id,
                    'difficulty_id' => $difficulty,
                    'task_status' => "Pending",
                    'created_at' => date('Y-m-d')
                ]); 
                
            }                
            $questions = Question::select('*')->where('task_id', $task_id)->get();
            if($questions == null){
                $task_type = 3;
            } else {
                $task_type = 1;
            }

            if($studentTask == true){
                return response()->json(['status' => true, 'message'=>"Updated successfully", 'task_type'=> $task_type]);
            } else {
                return response()->json(['status' => false, 'message'=> "Failed to update"]);
            }
        } else {
            return response()->json(['status'=>false, 'message'=>"Invalid token"]);
        }
    } else {
        return response()->json(['status'=>false, 'message'=>"No such user found"]);
    }
} 

//   //fetch tasks for students
//   public function fetchTasks(Request $request, $student_id){

//     $level_id = $request->level_id;
//     $difficulty_id = $request->difficulty_level;
//     if(Student::where('id', $student_id)->exists()){
//         $user_access_token  = $request->token;
//         $TokenCheck = Student::where('id', $student_id)->first();
//         $DB_token = json_decode($TokenCheck->remember_token, true);
     
//         if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {
               
//             $levelDetails = Level::select('mode')->where('id', $level_id)->get();
          
//             if($levelDetails == true){
               
//                 if($levelDetails[0]->mode === "Free"){
                
//                  $levelStatus = StudentDetail::select('level_status')->where('student_id', $student_id)->first();
//                  $level_status = $levelStatus->level_status;
//                  if( $level_status == "Failed"){

//                      return response()->json(['status'=>False, 'message'=>"Failed in this level, please try again"]);
//                  } else {
//                    // To check the  no of questions in each difficulty level
//                     $difficultylevel = DifficultyLevel::select('no_of_questions')->where('id', $difficulty_id)->first();
               
//                     $no_of_questions = $difficultylevel->no_of_questions;
                   
//                     //To count the no of tasks stduent had so far done.
//                     $studentTaskDetails = StudentTask::where(['student_id'=> $student_id, 'difficulty_id' => $difficulty_id])->count('*');
                    
//                     //    dd($studentTaskDetails);
//                     if( $no_of_questions == $studentTaskDetails){

//                           $this->updateStudentDetail($user_access_token, $student_id, $difficulty_id,$level_id, $no_of_questions);

                      
//                     } else{
//                         $previouslyGivenTaskIds = StudentTask::where('student_id', $student_id)
//                                                 ->pluck('task_id')
//                                                 ->toArray();

//                        // Fetch the sequential tasks
//                             $sequentialTasks = Task::leftJoin('difficulty_levels', 'tasks.difficulty_level', '=', 'difficulty_levels.id')
//                             ->select('tasks.task_id', 'tasks.task_name', 'tasks.task_desc', 'tasks.time', 'tasks.NofQstnsAns', 'difficulty_levels.level_name as difficultyLevel')
//                             ->where('tasks.task_level', $level_id)
//                             ->where('tasks.difficulty_level', $difficulty_id)
//                             ->whereNotIn('tasks.task_id', $previouslyGivenTaskIds)
//                             ->where('tasks.order', 2)
//                             ->orderBy('tasks.sort_order', 'asc')
//                             ->get();

//                             // Initialize $result variable
//                             $result = null;

//                             // If there are sequential tasks, use them; otherwise, fetch a random task
//                             if ($sequentialTasks->isNotEmpty()) {
//                             $result = $sequentialTasks;
//                             } else {
//                             $randomTask = Task::leftJoin('difficulty_levels', 'tasks.difficulty_level', '=', 'difficulty_levels.id')
//                                 ->select('tasks.task_id', 'tasks.task_name', 'tasks.task_desc', 'tasks.time', 'tasks.NofQstnsAns', 'difficulty_levels.level_name as difficultyLevel')
//                                 ->where('tasks.task_level', $level_id)
//                                 ->where('tasks.difficulty_level', $difficulty_id)
//                                 ->whereNotIn('tasks.task_id', $previouslyGivenTaskIds)
//                                 ->where(function ($query) {
//                                     $query->where('tasks.order', 1)
//                                         ->orWhereNull('tasks.order');
//                                 })
//                                 ->inRandomOrder()
//                                 ->first();

//                             // Wrap the random task in a collection to maintain consistency with the result type
//                             $result = collect([$randomTask]);
//                             }

                                            
                  
//                         // $result = Task::leftjoin('difficulty_levels','tasks.difficulty_level','=','difficulty_levels.id')
//                         //                 ->select('tasks.task_id','tasks.task_name','tasks.task_desc', 'tasks.time', 'tasks.NofQstnsAns','difficulty_levels.level_name as difficultyLevel')
//                         //                 ->where(['task_level'=> $level_id, 'difficulty_level'=> $difficulty_id])
//                         //                 ->whereNotIn(['tasks.task_id'=> $previouslyGivenTaskIds])
//                         //                  // ->inRandomOrder()
//                         //                  ->orderBy('tasks.task_id', 'asc')
//                         //                 ->first();
            
                    
//                         $result['level_id'] = (int)$level_id;
//                         $result['difficulty_level'] = (int)$difficulty_id;

//                         if ($result !== null && isset($result->task_id)) {
//                             $task_id = $result->task_id;
//                             $taskAttchmentCount = AdminTaskAttachment::where('task_id', $task_id)->count('*');
//                             if( $taskAttchmentCount > 0){
//                             $attachment = AdminTaskAttachment::select('id', 'file_name')->where('task_id', $task_id)->get();
                                            
//                             for($i = 0; $i < $taskAttchmentCount; $i++){
//                                     $taskAttachment[$i] = $this->downloadFile( $attachment[$i]['id']);
//                                               // Generate a unique download URL for each attachment
//                                     $taskAttachmentUrls[$i] = url('/api/task_file_download/' . $attachment[$i]['id']); // Adjust the URL structure as needed
//                             }
                                    
//                                              // Create an array to hold the attachment data with download links
//                             $attachmentData = [];
                                    
//                                             // Populate the attachment data array with the necessary information
//                             for ($i = 0; $i < $taskAttchmentCount; $i++) {
//                                     $attachmentData[$i] = [
//                                     'id' => $attachment[$i]['id'],
//                                     'file_name' => $attachment[$i]['file_name'],
//                                     'download_link' => $taskAttachmentUrls[$i],
//                                                 // Add more fields if needed
//                                     ];
//                             }
//                             $result['files'] = $attachmentData;
//                            }
//                             return response()->json(['status' => true, 'message' => "Task retreived", 'data'=>$result]);
// 			//	return response()->json(['status' => false, 'message' => "Failed to fetch task"]);

//                         } else {
//                             return response()->json(['status' => false, 'message' => "Failed to fetch task"]);
//                         }
//                     }
//                 }
//                 } else {
//                      return response()->json(['status' => false, 'message' => "Your free attempts are finished. Please subscribe to proceed"]);
//                 }
                
//                // return response()->json(['status' => true, 'message'=>"Data retreived"]);
//             } else {
//                 return response()->json(['status' => false, 'message'=>"Failed to retreive data"]);
//             }
        
//         } else {
//             return response()->json(['status'=>false, 'message'=>"Invalid token"]);
//         }
//     } else {
//         return response()->json(['status'=>false, 'message'=> "No such user"]);
//     }
// }

//fetch tasks for students
public function fetchTasks(Request $request, $student_id)
{
  //  $level_id = $request->level_id;
  //  $difficulty_id = $request->difficulty_level;

    $student_info = StudentDetail::select('level_id','difficulty_level')->where('student_id',$student_id)->first();
    $level_id = $student_info->level_id;
    $difficulty_id = $student_info->difficulty_level;
    $user_access_token = $request->token;

    // Check if student exists and token is valid
    if (Student::where('id', $student_id)->exists()) {
        $TokenCheck = Student::where('id', $student_id)->first();
        $DB_token = json_decode($TokenCheck->remember_token, true);

        if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {

             $levelDetails = Level::select('mode')->where('id', $level_id)->first();

          //  if ($levelDetails && $levelDetails->mode === "Free") {

                $levelStatus = StudentDetail::select('level_status')->where('student_id', $student_id)->first();
                $level_status = $levelStatus->level_status;

                if ($level_status === "Failed") {
                    return response()->json(['status' => false, 'message' => "Failed in this level, please try again"]);
                } else {

                    // Get the number of questions in each difficulty level
                    $difficultylevel = DifficultyLevel::select('no_of_questions')->where('id', $difficulty_id)->first();
                    $no_of_questions = $difficultylevel->no_of_questions;

                    // Count the number of tasks the student has completed so far
                    $studentTaskDetails = StudentTask::where(['student_id' => $student_id, 'difficulty_id' => $difficulty_id])->count();

                    $availableTasksCount = Task::leftJoin('difficulty_levels', 'tasks.difficulty_level', '=', 'difficulty_levels.id')
                                ->where('tasks.task_level', $level_id)
                                ->where('tasks.difficulty_level', $difficulty_id)
                                ->whereNotIn('tasks.task_id', StudentTask::where(['student_id' => $student_id, 'difficulty_id' => $difficulty_id])->pluck('task_id')->toArray())
                                ->count();
                   
                    if ($availableTasksCount == 0) {
                            $this->updateStudentDetail($user_access_token, $student_id, $difficulty_id, $level_id, $no_of_questions);
                            return response()->json(['status' => false, 'message' => "No more tasks found in this level"]);
                    } else {
                    if ($no_of_questions == $studentTaskDetails) {
                        
                        $this->updateStudentDetail($user_access_token, $student_id, $difficulty_id, $level_id, $no_of_questions);
                            
                     //   $this->updateStudentDetail($user_access_token, $student_id, $difficulty_id, $level_id, $no_of_questions);
                    } else {

                        // Fetch previously given task IDs
                        $previouslyGivenTaskIds = StudentTask::where(['student_id'=> $student_id, 'level_id' => $level_id, 'difficulty_id' => $difficulty_id])
                            ->pluck('task_id')
                            ->toArray();

                        // Fetch the first sequential task
                        $sequentialTask = Task::leftJoin('difficulty_levels', 'tasks.difficulty_level', '=', 'difficulty_levels.id')
                            ->select('tasks.task_id', 'tasks.task_name', 'tasks.task_desc', 'tasks.time', 'tasks.NofQstnsAns', 'difficulty_levels.level_name as difficultyLevel')
                            ->where('tasks.task_level', $level_id)
                            ->where('tasks.difficulty_level', $difficulty_id)
                            ->whereNotIn('tasks.task_id', $previouslyGivenTaskIds)
                            ->where('tasks.order', 2)
                            ->orderBy('tasks.sort_order', 'asc')
                            ->first();
                      
                       
                        // Initialize $result variable
                        $result = null;

                        // If there is a sequential task, use it; otherwise, fetch a random task
                        if ($sequentialTask) {
                            $result = $sequentialTask;
                        } else {

                            $randomTask = Task::leftJoin('difficulty_levels', 'tasks.difficulty_level', '=', 'difficulty_levels.id')
                                ->select('tasks.task_id', 'tasks.task_name', 'tasks.task_desc', 'tasks.time', 'tasks.NofQstnsAns', 'difficulty_levels.level_name as difficultyLevel')
                                ->where('tasks.task_level', $level_id)
                                ->where('tasks.difficulty_level', $difficulty_id)
                                ->whereNotIn('tasks.task_id', $previouslyGivenTaskIds)
                                ->where('tasks.order', 1)

                                ->inRandomOrder()
                                ->first();
                          
                            // Assign the random task to result
                            $result = $randomTask;
                        }

                        // Process task attachments if available
                        if ($result) {
                            $task_id = $result->task_id;
                            $taskAttchmentCount = AdminTaskAttachment::where('task_id', $task_id)->count();

                            if ($taskAttchmentCount > 0) {
                                $attachment = AdminTaskAttachment::select('id', 'file_name')->where('task_id', $task_id)->get();

                                $attachmentData = [];
                                foreach ($attachment as $att) {
                                    $attachmentData[] = [
                                        'id' => $att->id,
                                        'file_name' => $att->file_name,
                                        'download_link' => url('/api/task_file_download/' . $att->id)
                                    ];
                                }
                                $result->files = $attachmentData;
                            }

                            // Return response
                            return response()->json(['status' => true, 'message' => "Task retrieved", 'data' => $result]);
                        } else {
                            return response()->json(['status' => false, 'message' => "Please complete the level 1 tasks to proceed to next level"]);
                        }
                    }
                }
                }
       //     } else {
        //        return response()->json(['status' => false, 'message' => "Your free attempts are finished. Please subscribe to proceed"]);
        //    }
        } else {
            return response()->json(['status' => false, 'message' => "Invalid token"]);
        }
    } else {
        return response()->json(['status' => false, 'message' => "No such user"]);
    }
}

//Update difficulty level in student detail table
  public function updateStudentDetail($token, $student_id, $difficulty_id, $level_id, $no_of_questions){

  // Check whether the student has passed the difficulty level exam
  $levelStatus = StudentTask::where(['student_id' => $student_id, 'difficulty_id' => $difficulty_id, 'is_completed' => 1])
  ->count();

  $availableTasksCount = Task::leftJoin('difficulty_levels', 'tasks.difficulty_level', '=', 'difficulty_levels.id')
                                ->where('tasks.task_level', $level_id)
                                ->where('tasks.difficulty_level', $difficulty_id)
                                ->whereNotIn('tasks.task_id', StudentTask::where(['student_id' => $student_id, 'difficulty_id' => $difficulty_id])->pluck('task_id')->toArray())
                                ->count();

    if($availableTasksCount == 0){
        $nextDifficultyId = DifficultyLevel::where('id', '>', $difficulty_id)
        ->orderBy('id')
        ->pluck('id')
        ->first();
  
    if ($nextDifficultyId !== null) {
        // Update student details with the next difficulty level
        StudentDetail::where('student_id', $student_id)->update(['difficulty_level' => $nextDifficultyId]);
  
        $requestArray = [
            'level_id' => (int)$level_id,
            'difficulty_level' => $nextDifficultyId,
            'token' => $token,
        ];
  
        $this->fetchTasks(new Request($requestArray), $student_id);
  
    } else {
          $intern_mode = StudentDetail::select('mode')->where('student_id', $student_id)->first(); 
        // If there is no next difficulty level, check for the next level
        $nextLevel = Level::where('id', '>', $level_id)
            ->orderBy('id')
            ->first();
  
       
            if ($nextLevel !== null) {
 $level_mode = Level::select('mode')->where('id', $nextLevel->id)->first();
        if($intern_mode->mode === $level_mode->mode){
                $nextLevelID = $nextLevel->id;
                // Update student details with the next level
                StudentDetail::where('student_id', $student_id)->update(['level_id' => $nextLevelID]);
      
                $requestArray = [
                    'level_id' => $nextLevelID,
                    'difficulty_id' => $nextDifficultyId,
                    'token' => $token,
                ];
      
                $this->fetchTasks(new Request($requestArray), $student_id);
      } else {
            return response()->json(['status' => true, 'message' => 'Please subscribe to proceed']);
        }
            } else {
                // No more levels
                return response()->json(['status' => true, 'message' => 'No more levels']);
            }
        
       
    }
    } else {
        if ($levelStatus == (int)$no_of_questions) {
            // If all tasks in difficulty level are passed, update the next difficulty level
          
            $nextDifficultyId = DifficultyLevel::where('id', '>', $difficulty_id)
                ->orderBy('id')
                ->pluck('id')
                ->first();
          
            if ($nextDifficultyId !== null) {
                // Update student details with the next difficulty level
                StudentDetail::where('student_id', $student_id)->update(['difficulty_level' => $nextDifficultyId]);
          
                $requestArray = [
                    'level_id' => (int)$level_id,
                    'difficulty_level' => $nextDifficultyId,
                    'token' => $token,
                ];
          
                $this->fetchTasks(new Request($requestArray), $student_id);
          
            } else {
                 $intern_mode = StudentDetail::select('mode')->where('student_id', $student_id)->first(); 
                // If there is no next difficulty level, check for the next level
                $nextLevel = Level::where('id', '>', $level_id)
                    ->orderBy('id')
                    ->first();
        
          
                if ($nextLevel !== null) {
 		$level_mode = Level::select('mode')->where('id', $nextLevel->id)->first();
                if($intern_mode->mode === $level_mode->mode){
                    $nextLevelID = $nextLevel->id;
                    // Update student details with the next level
                    StudentDetail::where('student_id', $student_id)->update(['level_id' => $nextLevelID]);
          
                    $requestArray = [
                        'level_id' => $nextLevelID,
                        'difficulty_id' => $nextDifficultyId,
                        'token' => $token,
                    ];
          
                    $this->fetchTasks(new Request($requestArray), $student_id);
            } else {
                return response()->json(['status' => true, 'message' => 'Please subscribe to proceed']);
            }
                } else {

                    // No more levels
                    return response()->json(['status' => true, 'message' => 'No more levels']);
                }
          
            } 
                    
          } else {
            // If the student did not pass the difficulty level
            StudentDetail::where('student_id', $student_id)->update(['level_status' => 'Failed']);
          
            $requestArray = [
                'level_id' => $level_id,
                'difficulty_id' => $difficulty_id,
                'token' => $token,
            ];
          
            $this->fetchTasks(new Request($requestArray), $student_id);
          
            // Return a response indicating failure
            return response()->json(['status' => false, 'message' => 'Failed in this level, Please try again']);
          }
    }

    }


  //Update difficulty level in student detail table
 // public function updateStudentDetail($token, $student_id, $difficulty_id, $level_id, $no_of_questions){

 //  $levelStatus = StudentTask::where(['student_id' => $student_id, 'difficulty_id' => $difficulty_id, 'is_completed' => 1])
 // ->count();

//if ($levelStatus == (int)$no_of_questions) {

  //$nextDifficultyId = DifficultyLevel::where('id', '>', $difficulty_id)
   //   ->orderBy('id')
    //  ->pluck('id')
     // ->first();

 // if ($nextDifficultyId !== null) {
      // Update student details with the next difficulty level
   //   StudentDetail::where('student_id', $student_id)->update(['difficulty_level' => $nextDifficultyId]);

     // $requestArray = [
       //   'level_id' => (int)$level_id,
         // 'difficulty_level' => $nextDifficultyId,
         // 'token' => $token,
     // ];

     // $this->fetchTasks(new Request($requestArray), $student_id);

  //} else {
      // If there is no next difficulty level, check for the next level
    //  $nextLevel = Level::where('id', '>', $level_id)
      //    ->orderBy('id')
        //  ->first();

     // if ($nextLevel !== null) {
       //   $nextLevelID = $nextLevel->id;
          // Update student details with the next level
         // StudentDetail::where('student_id', $student_id)->update(['level_id' => $nextLevelID]);

         // $requestArray = [
           //   'level_id' => $nextLevelID,
            //  'difficulty_id' => $nextDifficultyId,
             // 'token' => $token,
         // ];

         // $this->fetchTasks(new Request($requestArray), $student_id);

      //} else {
          // No more levels
        //  return response()->json(['status' => true, 'message' => 'No more levels']);
     // }
 // }

//} else {
  // If the student did not pass the difficulty level
  //StudentDetail::where('student_id', $student_id)->update(['level_status' => 'Failed']);

  //$requestArray = [
    //  'level_id' => $level_id,
     // 'difficulty_id' => $difficulty_id,
     // 'token' => $token,
  //];

  //$this->fetchTasks(new Request($requestArray), $student_id);

  // Return a response indicating failure
  //return response()->json(['status' => false, 'message' => 'Failed in this level, Please try again']);
//}

  //  }

  //Add description adn file upload from frontend
  public function taskAttachments(Request $request, $student_id) {
  
    $task_id = $request->task_id;
  //   $student_task = StudentTask::select('task_id')->where(['student_id' => $student_id, 'is_completed' => 0])->orderBy('created_at', 'desc')->first();
  //   $task_id = $student_task->task_id;
    $taskDetails = Task::select('task_level','difficulty_level')->where('task_id', $task_id)->first();

    $level_id = $taskDetails->task_level;
    $difficulty = $taskDetails->difficulty_level;
    if(Student::where('id', $student_id)->exists()){
	$user_access_token  = $request->token;
        $TokenCheck = Student::where('id', $student_id)->first();
        $DB_token = json_decode($TokenCheck->remember_token, true);
     
        if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {
            $description = $request->description ? $request->description : "Completed";
            
             
             if ($request->hasFile('file')) {
                 
                 $file = $request->file('file');
                 $originalName = $file->getClientOriginalName();
                 $fileName = $file->hashName();
                 $filePath = $file->store('uploads');
             } else {
                 
                 $fileName = null;
                 $originalName = null;
                 $filePath = null;
             }
             $result = TaskAttachment::insert([
                 'task_id' => $task_id,
                 'student_id' => $student_id,
                 'description' => $description,
                 'level_id' => $level_id,
                 'difficulty_id' => $difficulty,
                 'file_name' => $fileName,
                 'original_name' => $originalName,
                 'file_path' => $filePath,
                 'created_at' => date('Y-m-d')
             ]);
              $duration = $request->time_taken;
              $start_date = $request->start_date;
          //  $end_date = $request->end_date;
             $is_completed = $request->is_completed;
             $result = StudentTask::where(['student_id' => $student_id, 'task_id'=> $task_id])->update([
                'student_id' => $student_id,
                'task_id' => $task_id,
                'is_completed' => $is_completed,
                'time_taken' => $duration,
                'start_date' => $start_date,
                'task_status' => "Completed",
                'level_id' => $level_id,
                'difficulty_id' => $difficulty,
                'created_at' => date('Y-m-d')
            ]);

             
             $data = array([
                 'student_id' => $student_id,
                 'task_id' => $task_id,
                 'level_id' => $level_id,
                 'difficulty_level' => $difficulty
             ]);

            if($result == true){
                return response()->json(['status'=>true, 'message'=>"Task attachment added successfully", 'data'=>$data]);
            } else {
                return response()->json(['status' =>false, 'message'=>"Failed to add task attachements"]);
            }
        } else {
            return response()->json(['status'=>false, 'message'=>"Invalid token"]);
        }
    } else {
        return response()->json(['status'=>false, 'message'=>"No such student found"]);
    }
}

//Task completed from frontend
public function taskComplete(Request $request, $student_id, $task_id, $level_id, $difficulty_id){
    $task_id = $request->task_id;
    $level_id = $request->level_id;
    $difficulty_id = $request->difficulty_level; 
    if(Student::where('id', $student_id)->exists()){
	$user_access_token  = $request->token;
        $TokenCheck = Student::where('id', $student_id)->first();
        $DB_token = json_decode($TokenCheck->remember_token, true);
     
        if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {
     //   $token = $request->token;
     //   $userToken = Student::select('remember_token')->where('id', $student_id)->get();
     //   if($token == $userToken[0]->remember_token){
            $duration = $request->duration;
            $start_date = $request->start_date;
          //  $end_date = $request->end_date;
            $is_completed = $request->is_completed;
             $result = StudentTask::where(['student_id' => $student_id, 'task_id'=> $task_id])->update([
                'student_id' => $student_id,
                'task_id' => $task_id,
                'is_completed' => $is_completed,
                'time_taken' => $duration,
                'start_date' => $start_date,
                'task_status' => "Completed",
                'level_id' => $level_id,
                'difficulty_id' => $difficulty_id,
                'created_at' => date('Y-m-d')
            ]);


            $data = array([
                'student_id' => $student_id,
                'task_id' => $task_id,
                'level_id' => $level_id,
                'difficulty_level' => $difficulty_id
            ]);

            if($result == true){
                return response()->json(['status'=>true, 'message'=>"Proceed to questions", 'data'=>$data]);
            } else {
                return response()->json(['status'=>false, 'message'=>"Failed to update"]);
            }
            
        } else {
            return response()->json(['status'=>false, 'message'=>"Invalid token"]);
        }
    } else {
        return response()->json(['status'=>false, 'message'=>"No such student found"]);
    }
}

//  Fetch questions based on Taskid to students
public function fetchQuestions(Request $request, $student_id){

   $task_id = $request->task_id;

if(Student::where('id', $student_id)->exists()) {
$user_access_token  = $request->token;
        $TokenCheck = Student::where('id', $student_id)->first();
        $DB_token = json_decode($TokenCheck->remember_token, true);
     
        if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {
  //  $token = $request->token;
 //   $userToken = Student::where('id', $student_id)->value('remember_token');

  //  if($token == $userToken) {
        $questions = Question::where('task_id', $task_id)->get();
        $result = [];

        foreach($questions as $question) {
            $questionData = [
                'question_id' => $question->id,
                'question' => $question->question,
                'question_type' => $question->task_type
            ];

            if($question->task_type == 1) {
                $options = [
                    [
                        'optionId' => 'a',
                        'option' => $question->a
                    ],
                    [
                        'optionId' => 'b',
                        'option' => $question->b
                    ],
                    [
                        'optionId' => 'c',
                        'option' => $question->c
                    ],
                    [
                        'optionId' => 'd',
                        'option' => $question->d
                    ],
                    [
                        'optionId' => 'e',
                        'option' => $question->e
                    ]
                ];
                $questionData['options'] = $options;
            }

            $result[] = $questionData;
        }

        $questionsCount = count($questions);
        $questionsToBeAnswered = Task::where('task_id', $task_id)->value('NofQstnsAns');

        $response = [
            'status' => true,
            'message' => "Questions fetched",
            'task_id' => $task_id,
            'data' => $result,
            'No_of_questions_answered' => $questionsToBeAnswered
        ];

        return response()->json($response);
    } else {
        return response()->json(['status' => false, 'message' => "Invalid token"]);
    }
} else {
    return response()->json(['status' => false, 'message' => "No such student found"]);
}
    
}
 //Check answer
public function checkAnswer(Request $request, $student_id) {
    $task_id = $request->task_id;
    $inputAnswers = $request->input('answers');

    // Check if $inputAnswers is a string, if so, decode it
    if (is_string($inputAnswers)) {
        $options = json_decode($inputAnswers, true); // Decode JSON to associative array
    } else {
        // If $inputAnswers is already an array, use it directly
        $options = $inputAnswers;
    }

    // Validate that $options is an array
    if (!is_array($options)) {
        return response()->json(['status' => false, 'message' => 'Invalid answers format'], 400);
    }

    // Check if the student exists
    if (!Student::where('id', $student_id)->exists()) {
        return response()->json(['status' => false, 'message' => "No such student found"], 404);
    }

    // Validate the access token
    $user_access_token = $request->token;
    $TokenCheck = Student::where('id', $student_id)->first();
    $DB_token = json_decode($TokenCheck->remember_token, true);

    if (!$DB_token || !is_array($DB_token) || !in_array($user_access_token, $DB_token)) {
        return response()->json(['status' => false, 'message' => 'Invalid token'], 401);
    }

    // Get the total number of questions for the task
    $No_of_answered = Question::where('task_id', $task_id)->count();

    // Retrieve questions and key them by ID
    $questions = Question::select('id', 'answer', 'a', 'b', 'c', 'd', 'e', 'task_type')
        ->where('task_id', $task_id)
        ->get()
        ->keyBy('id')
        ->toArray();

    $correct = 0;
    $wrong = 0;
    $descriptiveTasks = [];
    $wrongAnswers = []; // Array to store wrong answers for feedback

    foreach ($options as $option) {
        if (isset($option['question_id']) && isset($option['option_id'])) {
            $questionId = $option['question_id'];
            $studentAnswer = $option['option_id'];

            if (isset($questions[$questionId])) {
                $question = $questions[$questionId];

                if ($question['task_type'] == 1) {
                    // Objective type question
                    if (strval($studentAnswer) === strval($question['answer'])) {
                        $correct++;
                    } else {
                        $wrong++;
                        $wrongAnswers[] = [
                            'question_id' => $questionId,
                            'correct_answer' => $question['answer'],
                            'student_answer' => $studentAnswer
                        ];
                    }
                } elseif ($question['task_type'] == 2) {
                    // Multiple choice type question
                    $columns = ['a', 'b', 'c', 'd', 'e'];
                    $found = false;
                    $studentAnswerStr = strval($studentAnswer);
                    
                    foreach ($columns as $column) {
    if (isset($question[$column])) {
        // Remove spaces from both the question value and the student answer
        $questionValue = str_replace(' ', '', strval($question[$column]));
        $studentAnswer = str_replace(' ', '', $studentAnswerStr);

        // Compare the modified values
        if ($questionValue === $studentAnswer) {
            $found = true;
            break;
        }
    }
}


               //     foreach ($columns as $column) {
               //         if (isset($question[$column]) && strval($question[$column]) === $studentAnswerStr) {
               //             $found = true;
               //             break;
               //         }
               //     }

                    if ($found) {
                        $correct++;
                    } else {
                        $wrong++;
                        $wrongAnswers[] = [
                            'question_id' => $questionId,
                            'correct_answer' => $this->getCorrectOption($question),
                            'student_answer' => $studentAnswer
                        ];
                    }
                } elseif ($question['task_type'] == 3) {
                    // Descriptive type question, needs manual correction
                    $descriptiveTasks[] = [
                        'intern_id' => $student_id,
                        'task_id' => $task_id,
                        'question' => $questionId,
                        'answer' => $studentAnswer,
                        'approve' => 0,
                        'created_at' => now()
                    ];
                }
            } else {
                // Handle case where question_id is not found in results
                return response()->json(['status' => false, 'message' => "Invalid question ID: $questionId"], 400);
            }
        } else {
            // Handle case where option does not have expected properties
            return response()->json(['status' => false, 'message' => 'Invalid answers format'], 400);
        }
    }

    // Insert descriptive tasks into the database
    if (count($descriptiveTasks) > 0) {
        ManualCorrection::insert($descriptiveTasks);
    }

    // Update student task answers
    StudentTask::where(['student_id' => $student_id, 'task_id' => $task_id])
        ->update(['student_answer' => json_encode($options)]);

    // Determine if the student has passed or failed
    $status = $correct >= $No_of_answered ? true : false;
    StudentTask::where(['student_id' => $student_id, 'task_id' => $task_id])
        ->update(['task_completion' => $status ? 1 : 0]);

    // Response with correct/incorrect information
    return response()->json([
        'status' => $status,
        'message' => $status ? 'Pass to next task' : 'Failed',
        'wrong_answers' => $wrongAnswers 
    ]);
}

// Helper function to get the correct option for multiple choice questions
private function getCorrectOption($question) {
    $nonNullOptions = [];

    foreach (['a', 'b', 'c', 'd', 'e'] as $column) {
        if (isset($question[$column]) && $question[$column] !== null) {
            $nonNullOptions[] = $question[$column];
        }
    }

    return $nonNullOptions;
   // foreach (['a', 'b', 'c', 'd', 'e'] as $column) {
   //     if (isset($question[$column]) && $question[$column] === $question['answer']) {
   //         return $question[$column];
   //     }
   // }
   // return null;
}

// Helper function to typecast answer appropriately
private function typecastAnswer($answer)
{
    // Check if answer is numeric
    if (is_numeric($answer)) {
        // Check if answer contains a decimal point
        if (strpos($answer, '.') !== false) {
            return floatval($answer); // Convert to float
        } else {
            return intval($answer); // Convert to integer
        }
    } else {
        return $answer; // Return as it is (string or character)
    }
}



//Get tasks for students
public function GetTasks(Request $request, $student_id){

    if(Student::where('id', $student_id)->exists()){
$user_access_token  = $request->token;
        $TokenCheck = Student::where('id', $student_id)->first();
        $DB_token = json_decode($TokenCheck->remember_token, true);
     
        if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {
    //    $token = $request->token;
        $level_id = $request->level_id;
        $task_id = $request->task_id;
     //   $userToken = Student::select('remember_token')->where('id', $student_id)->get();
    //    if($token == $userToken[0]->remember_token){
               
            $levelDetails = Level::select('mode')->where('id', $level_id)->get();
            
            if($levelDetails == true){
               
                if($levelDetails[0]->mode === "Free"){

                    $result = Task::select('task_name','task_desc','task_level','difficulty_level','NoOfQuestns')
                                    ->where(['task_id'=>$task_id, 'task_level'=>$level_id])
                                    ->first();
                    
                    if($result == true){
                        return response()->json(['status' => true, 'message' => "Task retreived", 'data'=>$result]);
                    } else {
                        return response()->json(['status' => false, 'message' => "Failed to fetch task"]);
                    }
                 
                } else {
                     return response()->json(['status' => false, 'message' => "Your free attempts are finished. Please subscribe to proceed"]);
                }
                
                return response()->json(['status' => true, 'message'=>"Data retreived", 'data'=>$mode]);
            } else {
                return response()->json(['status' => false, 'message'=>"Failed to retreive data"]);
            }
        
        } else {
            return response()->json(['status'=>false, 'message'=>"Invalid token"]);
        }
    }
  }


// Task view
public function TaskView(Request $request, $student_id){
  
$task_id = $request->task_id;
if (Student::where('id', $student_id)->exists()) {
$user_access_token  = $request->token;
        $TokenCheck = Student::where('id', $student_id)->first();
        $DB_token = json_decode($TokenCheck->remember_token, true);
     
        if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {
 //   $token = $request->token;
 //   $userToken = Student::select('remember_token')->where('id', $student_id)->get();
 //   if ($token == $userToken[0]->remember_token) {
        $result = Task::leftjoin('difficulty_levels','tasks.difficulty_level','=','difficulty_levels.id')
                    ->leftjoin('levels','tasks.task_level','=','levels.id')
                    ->select('tasks.task_name', 'tasks.task_desc', 'tasks.task_level', 'tasks.NoOfQuestns', 'tasks.NofQstnsAns', 'tasks.time as alloted_time', 'difficulty_levels.level_name as difficulty', 'levels.level_name')
                    ->where('task_id', $task_id)
		    ->distinct()
                    ->get();

         $taskAttachmentUrls = [];
        $attachmentData = [];

        $taskAttachmentCount = TaskAttachment::where(['task_id'=> $task_id, 'student_id' => $student_id])->count('*');
        
        
	$attachments = TaskAttachment::select('id', 'original_name')
   			 ->where(['task_id' => $task_id, 'student_id' => $student_id])
    			 ->get();

       
	$taskAttachmentUrls = [];
	$attachmentData = [];

	$hasValidAttachments = false;

	foreach ($attachments as $attachment) {
    		if ($attachment->original_name !== null) {
        	$hasValidAttachments = true; 

        
        $taskAttachmentUrls[$attachment->id] = url('/api/download/' . $attachment->id);
        
    
        $taskAttachment[$attachment->id] = $this->download($attachment->id);

     
        	$attachmentData[] = [
            	'id' => $attachment->id,
            	'file_name' => $attachment->original_name,
            	'download_link' => $taskAttachmentUrls[$attachment->id],
        	];
    		}
	}
	if (!$hasValidAttachments) {
    		$attachmentData =  [];
	}



     //   $attachment = TaskAttachment::select('id', 'original_name')->where(['task_id'=> $task_id, 'student_id' => $student_id])->get();
        
    //    for ($i = 0; $i < $taskAttachmentCount; $i++) {
     //       $taskAttachment[$i] = $this->download($attachment[$i]['id']);
    //        $taskAttachmentUrls[$i] = url('/api/download/' . $attachment[$i]['id']); 
    //    }

    //    for ($i = 0; $i < $taskAttachmentCount; $i++) {
    //        $attachmentData[$i] = [
    //            'id' => $attachment[$i]['id'],
    //            'file_name' => $attachment[$i]['original_name'],
    //            'download_link' => $taskAttachmentUrls[$i],
    //        ];
    //    }
      
        $questions = [];
        $question = Question::select('id', 'task_type')->where('task_id', $task_id)->get();

        foreach ($question as $q) {
            // Fetch student answer for the current question
            $student_answers = StudentTask::select('student_answer')
                ->where(['task_id' => $task_id, 'student_id' => $student_id])
                ->first();

            $decoded_answers = json_decode($student_answers->student_answer, true);

            // Initialize current_answer
            $current_answer = null;

            // If decoded_answers is null or not an array, set current_answer to null
            if ($decoded_answers == null || !is_array($decoded_answers)) {
                $current_answer = null;
            } else {
                // Find the answer for the current question
                foreach ($decoded_answers as $answer) {
                    if ($answer['question_id'] == $q['id']) {
                        $current_answer = $answer['option_id'];
                        break;
                    }
                }
            }

            // Fetch question details
            $single_question = Question::select('id as question_id', 'question', 'answer as original_answer', 'task_type')
                ->where(['task_id' => $task_id, 'id' => $q['id']])
                ->first();
		
	    $isAnswerCorrect = false;
            // If the task type is 1, fetch all options for the question
            if ($single_question['task_type'] == 1) {
                $options = Question::select('a', 'b', 'c', 'd', 'e')
                    ->where(['task_id' => $task_id, 'id' => $q['id']])
                    ->first();

                $formattedOptions = [];

                foreach ($options->getAttributes() as $field => $value) {
                    $formattedOptions[] = [
                        'optionId' => $field,
                        'option' => $value,
                    ];
                }

                // Include all options in the response
                $single_question['options'] = $formattedOptions;
                $single_question['student_answer'] = $current_answer;

            } elseif ($single_question['task_type'] == 2) {

                // If the task type is 2, fetch options and include student answer
                $options = Question::select('a', 'b', 'c', 'd', 'e')
                    ->where(['task_id' => $task_id, 'id' => $q['id']])
                    ->first();

                $formattedOptions = [];
		 foreach ($options->getAttributes() as $field => $value) {
                    $formattedOptions[] = [
                        'optionId' => $field,
                        'option' => $value,
                    ];
                }
		   
    		foreach ($formattedOptions as $option) {
       			 if ($option['option'] === $current_answer) {
            			$isAnswerCorrect = true;
           			 break;
        		}
   		 }
                  if ($isAnswerCorrect) {
            		$single_question['original_answer'] = $current_answer;
        	  } else {
                   	$single_question['original_answer'] = $formattedOptions[0]['option'];
        	}

               

                // Include options and student answer in the response
                $single_question['options'] = $formattedOptions;
                $single_question['student_answer'] = $current_answer;
            } else if($single_question['task_type'] == 3){

                $descriptive = ManualCorrection::select('*')->where(['task_id' => $task_id, 'intern_id' => $student_id])->first();

                if($descriptive != null){
                    $single_question['student_answer'] = $descriptive->answer;
		    $single_question['original_answer'] = $descriptive->answer;

                } else {
                    $single_question['student_answer'] = "Not answered";
                    $single_question['original_answer'] = "Not answered";

                }

            }

            // Add the question to the array
            $questions[] = $single_question;
        }

        // Assign questions and attachments to the result
        $result[0]['questions'] = $questions;
        $result[0]['attachments'] = $attachmentData;

        // Return the response
        return response()->json(['status'=>true, 'message'=>"Data retrieved", 'data'=> $result]);
    } else {
        return response()->json(['status'=>False, 'message'=>"Invalid token"]);
    }
} else {
    return response()->json(['status'=>False, 'message'=>"No such student found"]);
}

//               $task_id = $request->task_id;
//     if(Student::where('id', $student_id)->exists()){
//         $token = $request->token;
//         $userToken = Student::select('remember_token')->where('id', $student_id)->get();
//         if($token == $userToken[0]->remember_token){

//             $result = Task::leftjoin('difficulty_levels','tasks.difficulty_level','=','difficulty_levels.id')
//                         ->leftjoin('levels','tasks.task_level','=','levels.id')
//                         ->select('tasks.task_name', 'tasks.task_desc', 'tasks.task_level', 'tasks.NoOfQuestns', 'tasks.NofQstnsAns', 'tasks.time as alloted_time', 'difficulty_levels.level_name as difficulty', 'levels.level_name')
//                         ->where('task_id', $task_id)
//                         ->get();
           
//             $taskAttchmentCount = TaskAttachment::where(['task_id'=> $task_id, 'student_id' => $student_id])->count('*');
            
//             $attachment = TaskAttachment::select('id', 'original_name')->where(['task_id'=> $task_id, 'student_id' => $student_id])->get();
            
//             for($i = 0; $i < $taskAttchmentCount; $i++){
//                 $taskAttachment[$i] = $this->download( $attachment[$i]['id']);
//               // Generate a unique download URL for each attachment
//                 $taskAttachmentUrls[$i] = url('/api/download/' . $attachment[$i]['id']); // Adjust the URL structure as needed
//             }

//              // Create an array to hold the attachment data with download links
//             $attachmentData = [];

//             // Populate the attachment data array with the necessary information
//             for ($i = 0; $i < $taskAttchmentCount; $i++) {
//                 $attachmentData[$i] = [
//                     'id' => $attachment[$i]['id'],
//                     'file_name' => $attachment[$i]['original_name'],
//                     'download_link' => $taskAttachmentUrls[$i],
//                 // Add more fields if needed
//                 ];
//             }

//             $question = Question::select('id')->where('task_id',$task_id)->get();
      
//             $questionCount = count($question);
           
          
//             for ($i = 0; $i < $questionCount; $i++) {
//                 // Fetch student answer for the current question
//                 $student_answers = StudentTask::select('student_answer')
//                     ->where(['task_id' => $task_id, 'student_id' => $student_id])
//                     ->first();
            
//                 $decoded_answers = json_decode($student_answers->student_answer, true);
            
//                 // Initialize current_answer
//                 $current_answer = null;
            
//                 // If decoded_answers is null or not an array, set current_answer to null
//                 if ($decoded_answers == null || !is_array($decoded_answers)) {
//                     $current_answer = null;
//                 } else {
//                     // Find the answer for the current question
//                     foreach ($decoded_answers as $answer) {
//                         if ($answer['question_id'] == $question[$i]['id']) {
//                             $current_answer = $answer['option_id'];
//                             break;
//                         }
//                     }
//                 }
            
//                 // Fetch question details
//                 $questions[$i] = Question::select('id as question_id', 'question', 'answer as original_answer', 'task_type')
//                     ->where(['task_id' => $task_id, 'id' => $question[$i]['id']])
//                     ->first();
            
//                 // Include student answer in the question details
//                 $questions[$i]['student_answer'] = $current_answer;
            
//                 // If the task type is 1, fetch options
//                 if ($questions[$i]['task_type'] == 1) {
//                     $options[$i] = Question::select('a', 'b', 'c', 'd', 'e')
//                         ->where(['task_id' => $task_id, 'id' => $question[$i]['id']])
//                         ->first();
            
//                     // Format options
//                     $formattedOptions = [];
            
//                     foreach ($options[$i]->getAttributes() as $field => $value) {
//                         $formattedOptions[] = [
//                             'optionId' => $field,
//                             'option' => $value,
//                         ];
//                     }
            
//                     // Include options in the question details
//                     $questions[$i]['options'] = $formattedOptions;
//                 }
                
//                 // Include student answer in the question details
//                 $questions[$i]['student_answer'] = $current_answer;
//             }
            
            
//                 $result[0]['questions'] = $questions;
//                 $result[0]['attachments'] = $attachmentData;
        
//             if($result == true){
//                 return response()->json(['status'=>true, 'message'=>"Date retreived", 'data'=> $result]);
//             } else {
//                 return response()->json(['status'=>false, 'message'=> "Failed to fetch"]);
//             }
            
//         } else {
//             return response()->json(['status'=>False, 'message'=>"Invalid token"]);
//         }
//  }
}

public function download($id)
{
   $file = TaskAttachment::find($id);

if ($file) {
    $filename = $file->file_name;
    $originalname = $file->original_name;
    $filepath = $file->file_path;

    // Construct the full path to the file
    $fullPath = storage_path("app/{$filepath}");

    // Check if the file is a regular file
    if (is_file($fullPath)) {
        // Check if the file exists
        if (file_exists($fullPath)) {
            // Determine the MIME type of the file
            $mime = mime_content_type($fullPath);

            // Set the appropriate content type
            $headers = [
                'Content-Type' => $mime,
            ];

            // Return the file as a response
            return response()->file($fullPath, $headers);
        } else {
            // Log the file path for debugging
            \Log::error("File not found at path: {$fullPath}");

            // Return null or handle the error as needed
            return null;
        }
    } else {
        // Handle the case where the file is a directory
        $dir = "File cannot be downloaded, it's a directory";
        return $dir;
    }
} else {
    // Handle the case where the file record is not found
    return null;
}

}

// Progress bar
public function progressBar(Request $request, $student_id)
{
     
    $level_id = $request->level_id;
    if(Student::where('remember_token', $request->token)->exists()){
 
        $level = StudentDetail::leftjoin('levels','student_details.level_id','=','levels.id')
                                ->leftjoin('difficulty_levels', 'student_details.difficulty_level','=','difficulty_levels.id')
                                ->where(['student_details.student_id'=> $student_id, 'student_details.level_id'=> $level_id])
                                ->select('levels.id','levels.level_name', 'student_details.level_status','difficulty_levels.id as difficulty_id','difficulty_levels.level_name as difficulty_level') 
                                ->get();
        $result = [];
        if($level == true){
           
        for($i = 0; $i <count($level); $i++){     
        $result[$i]['level_id'] = $level[$i]['id'];
        $result[$i]['level_name'] = $level[$i]['level_name'];    
       
        $levelCount = DifficultyLevel::sum('no_of_questions');

        for ($i = 0; $i < count($level); $i++) {
            $taskCount[$i] = StudentTask::where(['student_id' => $student_id, 'level_id' => $result[$i]['level_id']])->count(); 
            $count[$i] = $taskCount[$i];
            $percent[$i] = ($levelCount > 0) ? (($count[$i] / $levelCount) * 100) : 0;
            $result[$i]['percent'] = $percent[$i];
        }
        }
      
        if($result == true){
            return response()->json(['status'=>true, 'message'=>"Data retreived", 'data' => $result]);
        } else {
            return response()->json(['status'=>false, 'message'=>"Failed to retreive"]);
        }
    } else {
        return response()->json(['status'=>false, 'message'=>"No levels found"]);
    }
 } else {
    return response()->json(['status'=>false, 'message'=>"No such user found"]);
 }
}

// Download files uploaded by admin for task
public function downloadFile($id)
{
    $fileDetails = AdminTaskAttachment::find($id);

    if (!$fileDetails) {
            
        $content = "File not found";
        return $content;
    }
    $filePath = storage_path("app/public/{$fileDetails->file_path}");
    if (!file_exists($filePath) || !is_readable($filePath)) {
    return null;
   }

        $fileName = $fileDetails->file_name;
        return response()->download($filePath, $fileName);
}


//Delete upload file

public function deleteFile($id){

    if(AdminTaskAttachment::where('id', $id)->exists()){

        $result =  AdminTaskAttachment::where('id', $id)->delete();
   
        if($result == 1){
            return response()->json(['status' => true, 'message' => "File deleted"]);
        } else {
            return response()->json(['status'=>false, 'message' => "Failed to delete file"]);
        }
    } else {
        return response()->json(['status'=>false, 'message'=>"No such file exists"]);
    }
}

// Reattempt task
public function ReattemptTask(Request $request,$intern_id){

    if(Student::where('id', $intern_id)->exists()){
        $user_access_token  = $request->token;
        $TokenCheck = Student::where('id', $intern_id)->first();
        $DB_token = json_decode($TokenCheck->remember_token, true);
     
        if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {
       
            $task_id = $request->task_id;

            if(Task::where('task_id', $task_id)->exists()){
                //check whether the student has attempted the task and status
                $student_attempt = StudentTask::select('is_completed')->where(['student_id'=>$intern_id, 'task_id'=> $task_id])->first();
                if($student_attempt == true){

                        if(ReattemptTask::where(['intern_id'=> $intern_id, 'task_id'=> $task_id])->exists()){

                            $task_order = Task::select('order')->where('task_id', $task_id)->first();
                            

                            if(($task_order->order == 1) || ($task_order->order == null)){


                                $get_count = ReattemptTask::select('count')->where(['intern_id'=> $intern_id, 'task_id'=> $task_id])->first();

                                if($get_count->count < 10){

                                $fetchTask = Task::leftjoin('levels','levels.id','=', 'tasks.task_level')
                                    ->leftjoin('difficulty_levels','difficulty_levels.id','=','tasks.difficulty_level')
                                    ->leftjoin('questions', 'questions.task_id', '=','tasks.task_id')
                                    ->select('tasks.task_id','tasks.task_name','tasks.task_desc','levels.level_name','difficulty_levels.level_name as difficulty_level',
                                            'tasks.task_type','tasks.time','tasks.order','questions.question','questions.answer','questions.a','questions.b','questions.c','questions.d','questions.e','questions.task_type' )
                                    ->where(['tasks.task_id'=>$task_id, 'tasks.is_active'=>1, 'tasks.is_admin_approved'=>1])
                                    ->first();
                    
                                $taskAttchmentCount = AdminTaskAttachment::where('task_id', $task_id)->count('*');
                                if( $taskAttchmentCount > 0){
                                    $attachment = AdminTaskAttachment::select('id', 'file_name')->where('task_id', $task_id)->get();
                                                                
                                    for($i = 0; $i < $taskAttchmentCount; $i++){
                                        $taskAttachment[$i] = $this->downloadFile( $attachment[$i]['id']);
                                            // Generate a unique download URL for each attachment
                                        $taskAttachmentUrls[$i] = url('/api/task_file_download/' . $attachment[$i]['id']); // Adjust the URL structure as needed
                                    }
                                                        
                                        // Create an array to hold the attachment data with download links
                                        $attachmentData = [];
                                                        
                                        // Populate the attachment data array with the necessary information
                                        for ($i = 0; $i < $taskAttchmentCount; $i++) {
                                            $attachmentData[$i] = [
                                                'id' => $attachment[$i]['id'],
                                                'file_name' => $attachment[$i]['file_name'],
                                                'download_link' => $taskAttachmentUrls[$i],
                                                    // Add more fields if needed
                                                ];
                                            }
                                        $fetchTask['files'] = $attachmentData;
                                    }

                                    $reattempt_count = ReattemptTask::where(['intern_id'=> $intern_id, 'task_id'=> $task_id])->update([
                                        
                                        'count' => $get_count->count + 1,
                                       
                                    ]);

                                    $extra = 10 - ($get_count->count + 1);

                                    if($fetchTask != null){

                                        return response()->json(['status'=>true, 'message'=> "Your number of reattempts left are $extra", 'data' => $fetchTask], 200);
                                    } else {
                                        return response()->json(['status'=>false, 'message'=>"Failed to fetch task", 'data'=>$fetchTask], 200);
                                    }
                                } else {
                                    return response()->json(['status'=>false, 'message'=>"It looks like you've used all your chances to reattempt this task. If you need more help, feel free to ask our instructor!"], 200);
                                }
                            } else {

                                $get_count = ReattemptTask::select('count')->where(['intern_id'=> $intern_id, 'task_id'=> $task_id])->first();

                                if($get_count->count < 3){

                                $fetchTask = Task::leftjoin('levels','levels.id','=', 'tasks.task_level')
                                    ->leftjoin('difficulty_levels','difficulty_levels.id','=','tasks.difficulty_level')
                                    ->leftjoin('questions', 'questions.task_id', '=','tasks.task_id')
                                    ->select('tasks.task_id','tasks.task_name','tasks.task_desc','levels.level_name','difficulty_levels.level_name as difficulty_level',
                                            'tasks.task_type','tasks.time','tasks.order','questions.question','questions.answer','questions.a','questions.b','questions.c','questions.d','questions.e','questions.task_type' )
                                    ->where(['tasks.task_id'=>$task_id, 'tasks.is_active'=>1, 'tasks.is_admin_approved'=>1])
                                    ->first();
                   
                                $taskAttchmentCount = AdminTaskAttachment::where('task_id', $task_id)->count('*');
                                if( $taskAttchmentCount > 0){
                                    $attachment = AdminTaskAttachment::select('id', 'file_name')->where('task_id', $task_id)->get();
                                                                
                                    for($i = 0; $i < $taskAttchmentCount; $i++){
                                        $taskAttachment[$i] = $this->downloadFile( $attachment[$i]['id']);
                                            // Generate a unique download URL for each attachment
                                        $taskAttachmentUrls[$i] = url('/api/task_file_download/' . $attachment[$i]['id']); 
                                    }
                                                        
                                        // Create an array to hold the attachment data with download links
                                        $attachmentData = [];
                                                        
                                        // Populate the attachment data array with the necessary information
                                        for ($i = 0; $i < $taskAttchmentCount; $i++) {
                                            $attachmentData[$i] = [
                                                'id' => $attachment[$i]['id'],
                                                'file_name' => $attachment[$i]['file_name'],
                                                'download_link' => $taskAttachmentUrls[$i],
                                                    // Add more fields if needed
                                                ];
                                            }
                                        $fetchTask['files'] = $attachmentData;
                                    }

                                    $reattempt_count = ReattemptTask::where(['intern_id'=> $intern_id, 'task_id'=> $task_id])->update([
                                        
                                        'count' => $get_count->count + 1,
                                       
                                    ]);

                                    $extra = 3 - ($get_count->count + 1);

                                 if($fetchTask != null){

                                    return response()->json(['status'=>true, 'message'=> "Your number of reattempts left are $extra", 'data'=> $fetchTask], 200);
                                 } else {
                                        return response()->json(['status'=>false, 'message'=>"Failed to fetch task", 'data'=>$fetchTask], 200);
                                    }


                                } else {
                                    return response()->json(['status'=>false, 'message'=>"It looks like you've used all your chances to reattempt this task. If you need more help, feel free to ask our instructor!"], 200);
                                }
                            } 
                        } else {
                          
                            $task_order = Task::select('order')->where('task_id', $task_id)->first();
                            

                            if(($task_order->order == 1) || ($task_order->order == null)){

                                $fetchTask = Task::leftjoin('levels','levels.id','=', 'tasks.task_level')
                                    ->leftjoin('difficulty_levels','difficulty_levels.id','=','tasks.difficulty_level')
                                    ->leftjoin('questions', 'questions.task_id', '=','tasks.task_id')
                                    ->select('tasks.task_id','tasks.task_name','tasks.task_desc','levels.level_name','difficulty_levels.level_name as difficulty_level',
                                            'tasks.task_type','tasks.time','tasks.order','questions.question','questions.answer','questions.a','questions.b','questions.c','questions.d','questions.e','questions.task_type' )
                                    ->where(['tasks.task_id'=>$task_id, 'tasks.is_active'=>1, 'tasks.is_admin_approved'=>1])
                                    ->first();
                    
                                $taskAttchmentCount = AdminTaskAttachment::where('task_id', $task_id)->count('*');
                                if( $taskAttchmentCount > 0){
                                    $attachment = AdminTaskAttachment::select('id', 'file_name')->where('task_id', $task_id)->get();
                                                                
                                    for($i = 0; $i < $taskAttchmentCount; $i++){
                                        $taskAttachment[$i] = $this->downloadFile( $attachment[$i]['id']);
                                            // Generate a unique download URL for each attachment
                                        $taskAttachmentUrls[$i] = url('/api/task_file_download/' . $attachment[$i]['id']); // Adjust the URL structure as needed
                                    }
                                                        
                                        // Create an array to hold the attachment data with download links
                                        $attachmentData = [];
                                                        
                                        // Populate the attachment data array with the necessary information
                                        for ($i = 0; $i < $taskAttchmentCount; $i++) {
                                            $attachmentData[$i] = [
                                                'id' => $attachment[$i]['id'],
                                                'file_name' => $attachment[$i]['file_name'],
                                                'download_link' => $taskAttachmentUrls[$i],
                                                    // Add more fields if needed
                                                ];
                                            }
                                        $fetchTask['files'] = $attachmentData;
                                    }

                                    $reattempt_count = ReattemptTask::insert([
                                        'intern_id'=> $intern_id,
                                        'task_id'=> $task_id,
                                        'count' => 1,
                                        'created_at' => date('Y-m-d')
                                       
                                    ]);

                                    $extra = 9;

                                    if($fetchTask != null){

                                        return response()->json(['status'=>true, 'message'=> "Your number of reattempts left are $extra", 'data' => $fetchTask], 200);
                                    } else {
                                        return response()->json(['status'=>false, 'message'=>"Failed to fetch task", 'data'=>$fetchTask], 200);
                                    }
                             
                            } else {

                                $fetchTask = Task::leftjoin('levels','levels.id','=', 'tasks.task_level')
                                    ->leftjoin('difficulty_levels','difficulty_levels.id','=','tasks.difficulty_level')
                                    ->leftjoin('questions', 'questions.task_id', '=','tasks.task_id')
                                    ->select('tasks.task_id','tasks.task_name','tasks.task_desc','levels.level_name','difficulty_levels.level_name as difficulty_level',
                                            'tasks.task_type','tasks.time','tasks.order','questions.question','questions.answer','questions.a','questions.b','questions.c','questions.d','questions.e','questions.task_type' )
                                    ->where(['tasks.task_id'=>$task_id, 'tasks.is_active'=>1, 'tasks.is_admin_approved'=>1])
                                    ->first();
                    
                                $taskAttchmentCount = AdminTaskAttachment::where('task_id', $task_id)->count('*');
                                if( $taskAttchmentCount > 0){
                                    $attachment = AdminTaskAttachment::select('id', 'file_name')->where('task_id', $task_id)->get();
                                                                
                                    for($i = 0; $i < $taskAttchmentCount; $i++){
                                        $taskAttachment[$i] = $this->downloadFile( $attachment[$i]['id']);
                                            // Generate a unique download URL for each attachment
                                        $taskAttachmentUrls[$i] = url('/api/task_file_download/' . $attachment[$i]['id']); // Adjust the URL structure as needed
                                    }
                                                        
                                        // Create an array to hold the attachment data with download links
                                        $attachmentData = [];
                                                        
                                        // Populate the attachment data array with the necessary information
                                        for ($i = 0; $i < $taskAttchmentCount; $i++) {
                                            $attachmentData[$i] = [
                                                'id' => $attachment[$i]['id'],
                                                'file_name' => $attachment[$i]['file_name'],
                                                'download_link' => $taskAttachmentUrls[$i],
                                                    // Add more fields if needed
                                                ];
                                            }
                                        $fetchTask['files'] = $attachmentData;
                                    }

                                    $reattempt_count = ReattemptTask::insert([
                                        'intern_id'=> $intern_id,
                                        'task_id'=> $task_id,
                                        'count' => 1,
                                        'created_at' => date('Y-m-d')
                                       
                                    ]);

                                    $extra = 2;
                                 if($fetchTask != null){

                                    return response()->json(['status'=>true, 'message'=> "Your number of reattempts left are $extra", 'data'=> $fetchTask], 200);
                                 } else {
                                        return response()->json(['status'=>false, 'message'=>"Failed to fetch task", 'data'=>$fetchTask], 200);
                                    }

                            } 
                        }
                  
                } else {
                    return response()->json(['status'=>false, 'message'=>"Student has not attempted the task"], 200);
                }
            } else {
                return response()->json(['status'=>false, 'message'=>"No such task found"], 400);
            }
            
        } else {
            return response()->json(['status'=>false, 'message'=> "Invalid token"], 401);
        }
    } else {
        return response()->json(['status'=>false, 'message'=>"Student doesnt exists"], 404);
    }

 }


 //Send descriptive tasks for manual correction
 public function ManualCorrection(Request $request){

    $intern_id = $request->intern_id;
    $task_id = $request->task_id;
    $questions = $request->questions; 

    foreach ($questions as $question) {
        ManualCorrection::insert([
            'intern_id' => $intern_id,
            'task_id' => $task_id,
            'question_id' => $question['question_id'],
            'answer' => $question['answer'],
            'created_at' => date('Y-m-d'),
            'approve' => 0
        ]);
    }

    return response()->json(['status' => true, 'message' => 'Descriptive tasks sent for manual correction']);
 }
 

 
//

}
 
