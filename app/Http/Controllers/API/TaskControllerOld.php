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

 public function tasklist(Request $request, $student_id){

 $level_id = $request->level_id;
    if(Student::where('remember_token', $request->token)->exists()){
 
        $level = StudentDetail::leftjoin('levels','student_details.level_id','=','levels.id')
                                ->leftjoin('difficulty_levels', 'student_details.difficulty_level','=','difficulty_levels.id')
                                ->where(['student_details.student_id'=> $student_id, 'student_details.level_id'=> $level_id])
                                ->select('levels.id','levels.level_name', 'student_details.level_status','difficulty_levels.id as difficulty_id','difficulty_levels.level_name as difficulty_level') 
                                ->distinct()
				->get();
        $result = [];
        if($level == true){
        for($i = 0; $i <count($level); $i++){     
        $result[$i]['level_id'] = $level[$i]['id'];
        $result[$i]['level_name'] = $level[$i]['level_name'];    
        $result[$i]['difficulty_level'] = $level[$i]['difficulty_level'];
        $result[$i]['difficulty_id'] = $level[$i]['difficulty_id'];
        $result[$i]['level_status'] = $level[$i]['level_status'];
        
        $tasks = StudentTask::leftjoin('levels','student_tasks.level_id','=','levels.id')
                                ->leftjoin('tasks','student_tasks.task_id','=','tasks.task_id')
                                ->select('tasks.task_id','tasks.task_name','tasks.time as total_time','student_tasks.is_completed','student_tasks.time_taken as timetaken','student_tasks.start_date', 'student_tasks.task_completion as status')
                                ->where(['student_tasks.level_id'=> $level[$i]['id'],'student_tasks.student_id'=>$student_id])
                                ->get();
     
        $result[$i]['tasks'] = $tasks;
        
           $levelCount = DifficultyLevel::sum('no_of_questions');

        for ($i = 0; $i < count($level); $i++) {

            $taskCount[$i] = StudentTask::where(['student_id' => $student_id, 'level_id' => $result[$i]['level_id']])->count(); 
            $count[$i] = $taskCount[$i];

            $percent[$i] = ($levelCount > 0) ? (($count[$i] / $levelCount) * 100) : 0;
            $result[$i]['progress'] = $percent[$i];

        }                  
        }

        if($result == true){
            return response()->json(['status'=>true, 'message'=>"Data retreived", 'data'=>$result]);
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
 
 //Attempt tasks
public function taskAttempt(Request $request, $student_id){
    $task_id = $request->task_id;
   
    if(Student::where('id', $student_id)->exists()){
        $token = $request->token;
        $userToken = Student::select('remember_token')->where('id', $student_id)->get();
        if($token == $userToken[0]->remember_token){
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

            if($studentTask == true){
                return response()->json(['status' => true, 'message'=>"Updated successfully"]);
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

  //fetch tasks for students
  public function fetchTasks(Request $request, $student_id){

    $level_id = $request->level_id;
    $difficulty_id = $request->difficulty_level;
    if(Student::where('id', $student_id)->exists()){
        $token = $request->token;
        $userToken = Student::select('remember_token')->where('id', $student_id)->get();
        if($token == $userToken[0]->remember_token){
               
            $levelDetails = Level::select('mode')->where('id', $level_id)->get();
            
            if($levelDetails == true){
               
                if($levelDetails[0]->mode === "Free"){
                
                 $levelStatus = StudentDetail::select('level_status')->where('student_id', $student_id)->first();
                 $level_status = $levelStatus->level_status;
                 if( $level_status == "Failed"){

                     return response()->json(['status'=>False, 'message'=>"Failed in this level, please try again"]);
                 } else {
                   // To check the  no of questions in each difficulty level
                    $difficultylevel = DifficultyLevel::select('no_of_questions')->where('id', $difficulty_id)->first();
               
                    $no_of_questions = $difficultylevel->no_of_questions;
                   
                    //To count the no of tasks stduent had so far done.
                    $studentTaskDetails = StudentTask::where(['student_id'=> $student_id, 'difficulty_id' => $difficulty_id])->count('*');
                    
                    //    dd($studentTaskDetails);
                    if( $no_of_questions == $studentTaskDetails){

                          $this->updateStudentDetail($token, $student_id, $difficulty_id,$level_id, $no_of_questions);

                      
                    } else{
                        $previouslyGivenTaskIds = StudentTask::where('student_id', $student_id)
                                                ->pluck('task_id')
                                                ->toArray();
                  
                        $result = Task::leftjoin('difficulty_levels','tasks.difficulty_level','=','difficulty_levels.id')
                                        ->select('tasks.task_id','tasks.task_name','tasks.task_desc', 'tasks.time', 'tasks.NofQstnsAns','difficulty_levels.level_name as difficultyLevel')
                                        ->where(['task_level'=> $level_id, 'difficulty_level'=> $difficulty_id])
                                        ->whereNotIn('tasks.task_id', $previouslyGivenTaskIds)
                                        ->inRandomOrder()
                                        ->first();
            
                      
                        $result['level_id'] = (int)$level_id;
                        $result['difficulty_level'] = (int)$difficulty_id;

                        if ($result !== null && isset($result->task_id)) {
                            $task_id = $result->task_id;
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
                            $result['files'] = $attachmentData;
                           }
                            return response()->json(['status' => true, 'message' => "Task retreived", 'data'=>$result]);
                        } else {
                            return response()->json(['status' => false, 'message' => "Failed to fetch task"]);
                        }
                    }
                }
                } else {
                     return response()->json(['status' => false, 'message' => "Your free attempts are finished. Please subscribe to proceed"]);
                }
                
               // return response()->json(['status' => true, 'message'=>"Data retreived"]);
            } else {
                return response()->json(['status' => false, 'message'=>"Failed to retreive data"]);
            }
        
        } else {
            return response()->json(['status'=>false, 'message'=>"Invalid token"]);
        }
    } else {
        return response()->json(['status'=>false, 'message'=> "No such user"]);
    }
}

  //Update difficulty level in student detail table
  public function updateStudentDetail($token, $student_id, $difficulty_id, $level_id, $no_of_questions){

  // Check whether the student has passed the difficulty level exam
  $levelStatus = StudentTask::where(['student_id' => $student_id, 'difficulty_id' => $difficulty_id, 'is_completed' => 1])
  ->count();

if ($levelStatus == (int)$no_of_questions) {
  // If all tasks in difficulty level are passed, update the next difficulty level

  $nextDifficultyId = DifficultyLevel::where('id', '>', $difficulty_id)
      ->orderBy('id')
      ->pluck('id')
      ->first();

  if ($nextDifficultyId !== null) {
      // Update student details with the next difficulty level
      StudentDetail::where('student_id', $student_id)->update(['difficulty_id' => $nextDifficultyId]);

      $requestArray = [
          'level_id' => (int)$level_id,
          'difficulty_level' => $nextDifficultyId,
          'token' => $token,
      ];

      $this->fetchTasks(new Request($requestArray), $student_id);

  } else {
      // If there is no next difficulty level, check for the next level
      $nextLevel = Level::where('id', '>', $level_id)
          ->orderBy('id')
          ->first();

      if ($nextLevel !== null) {
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

  //Add description adn file upload from frontend
  public function taskAttachments(Request $request, $student_id) {
    
    $task_id = $request->task_id;
    $level_id = $request->level_id;
    $difficulty = $request->difficulty_level;
    if(Student::where('id', $student_id)->exists()){
        $token = $request->token;
        $userToken = Student::select('remember_token')->where('id', $student_id)->get();
        if($token == $userToken[0]->remember_token){
            $description = $request->description;
            // $file = $request->file;
             
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
        $token = $request->token;
        $userToken = Student::select('remember_token')->where('id', $student_id)->get();
        if($token == $userToken[0]->remember_token){
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
    $token = $request->token;
    $userToken = Student::where('id', $student_id)->value('remember_token');

    if($token == $userToken) {
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
public function checkAnswer(Request $request, $student_id){
    $task_id = $request->task_id;
$options = $request->input('answers');

if (Student::where('id', $student_id)->exists()) {
    $token = $request->token;
    $userToken = Student::select('remember_token')->where('id', $student_id)->get();

    if ($token == $userToken[0]->remember_token) {
        $questionsToBeAnswered = Task::select('NofQstnsAns')->where('task_id', $task_id)->get();
        $No_of_answered = $questionsToBeAnswered[0]->NofQstnsAns;
        $result = Question::select('answer', 'id')->where(['task_id' => $task_id])->orderBy('id', 'asc')->get();

        $correct = 0;
        $wrong = 0;

        foreach ($options as $option) {
            $answer = Question::select('answer')->where(['task_id' => $task_id, 'id' => $option['question_id']])->first();

            $student_answer = $option['option_id'];
            $original_answer = $answer['answer'];

            // Typecast answers appropriately for comparison
            $student_answer = $this->typecastAnswer($student_answer);
            $original_answer = $this->typecastAnswer($original_answer);

            if ($student_answer == $original_answer) {
                $correct++;
            } else {
                $wrong++;
            }
        }

        $studentAnswers = StudentTask::where(['student_id' => $student_id, 'task_id' => $task_id])->update([
            'student_answer' => json_encode($options) // Assuming you need to store options as JSON
        ]);

        if ($correct >= $No_of_answered) {
            $updateTask = StudentTask::where(['student_id' => $student_id, 'task_id' => $task_id])->update([
                'task_completion' => 1
            ]);
            return response()->json(['status' => true, 'message' => "Pass to next task"]);
        } else {
            $updateTask = StudentTask::where(['student_id' => $student_id, 'task_id' => $task_id])->update([
                'task_completion' => 0
            ]);
            return response()->json(['status' => false, 'message' => "Failed"]);
        }
    } else {
        return response()->json(['status' => false, 'message' => "Invalid token"]);
    }
} else {
    return response()->json(['status' => false, 'message' => "No such student found"]);
}
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
        $token = $request->token;
        $level_id = $request->level_id;
        $task_id = $request->task_id;
        $userToken = Student::select('remember_token')->where('id', $student_id)->get();
        if($token == $userToken[0]->remember_token){
               
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
    if(Student::where('id', $student_id)->exists()){
        $token = $request->token;
        $userToken = Student::select('remember_token')->where('id', $student_id)->get();
        if($token == $userToken[0]->remember_token){

            $result = Task::leftjoin('difficulty_levels','tasks.difficulty_level','=','difficulty_levels.id')
                        ->leftjoin('levels','tasks.task_level','=','levels.id')
                        ->select('tasks.task_name', 'tasks.task_desc', 'tasks.task_level', 'tasks.NoOfQuestns', 'tasks.NofQstnsAns', 'tasks.time as alloted_time', 'difficulty_levels.level_name as difficulty', 'levels.level_name')
                        ->where('task_id', $task_id)
                        ->get();
           
            $taskAttchmentCount = TaskAttachment::where(['task_id'=> $task_id, 'student_id' => $student_id])->count('*');
            
            $attachment = TaskAttachment::select('id', 'original_name')->where(['task_id'=> $task_id, 'student_id' => $student_id])->get();
            
            for($i = 0; $i < $taskAttchmentCount; $i++){
                $taskAttachment[$i] = $this->download( $attachment[$i]['id']);
              // Generate a unique download URL for each attachment
                $taskAttachmentUrls[$i] = url('/api/download/' . $attachment[$i]['id']); // Adjust the URL structure as needed
            }

             // Create an array to hold the attachment data with download links
            $attachmentData = [];

            // Populate the attachment data array with the necessary information
            for ($i = 0; $i < $taskAttchmentCount; $i++) {
                $attachmentData[$i] = [
                    'id' => $attachment[$i]['id'],
                    'file_name' => $attachment[$i]['original_name'],
                    'download_link' => $taskAttachmentUrls[$i],
                // Add more fields if needed
                ];
            }

            $question = Question::select('id')->where('task_id',$task_id)->get();
      
            $questionCount = count($question);
           
          
            for ($i = 0; $i < $questionCount; $i++) {
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
                        if ($answer['question_id'] == $question[$i]['id']) {
                            $current_answer = $answer['option_id'];
                            break;
                        }
                    }
                }
            
                // Fetch question details
                $questions[$i] = Question::select('id as question_id', 'question', 'answer as original_answer', 'task_type')
                    ->where(['task_id' => $task_id, 'id' => $question[$i]['id']])
                    ->first();
            
                // Include student answer in the question details
                $questions[$i]['student_answer'] = $current_answer;
            
                // If the task type is 1, fetch options
                if ($questions[$i]['task_type'] == 1) {
                    $options[$i] = Question::select('a', 'b', 'c', 'd', 'e')
                        ->where(['task_id' => $task_id, 'id' => $question[$i]['id']])
                        ->first();
            
                    // Format options
                    $formattedOptions = [];
            
                    foreach ($options[$i]->getAttributes() as $field => $value) {
                        $formattedOptions[] = [
                            'optionId' => $field,
                            'option' => $value,
                        ];
                    }
            
                    // Include options in the question details
                    $questions[$i]['options'] = $formattedOptions;
                }
                
                // Include student answer in the question details
                $questions[$i]['student_answer'] = $current_answer;
            }
            
            
                $result[0]['questions'] = $questions;
                $result[0]['attachments'] = $attachmentData;
        
            if($result == true){
                return response()->json(['status'=>true, 'message'=>"Date retreived", 'data'=> $result]);
            } else {
                return response()->json(['status'=>false, 'message'=> "Failed to fetch"]);
            }
            
        } else {
            return response()->json(['status'=>False, 'message'=>"Invalid token"]);
        }
 }
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

}
 
