<?php

namespace App\Http\Controllers;
use App\Models\Task;
use App\Models\User;
use App\Models\Question;
use Validator;
use DB;
use Session;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;


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
    
     $user = Session::get('user'); 
     $user_id = $user->id;
     $user_access_token  = $user->remember_token;
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
        //  $save_template = $request->save_template ? $request->save_template:null;
          //$token = $request->token;
       
        $result = Task::insert([
            'task_name' => $task_name,
            'task_desc' => $task_desc,
            'created_by' => $user_id,
            'task_level' => $task_level,
            'is_active' => $is_active,
            'NoOfQuestns' => $NoOfQuestns,
            'NofQstnsAns' => $NofQstnsAns,
            'difficulty_level' => $difficulty_level,
            'save_template' => '1',
            'created_at' => date('Y-m-d h:m:s'),
            'question_limit' => $NoOfQuestns
        ]);
            if($result == true){
                $GetlastId = Task::select('task_id')->where('task_name', $task_name)->get();
                $task_id = $GetlastId[0]->task_id;
               // return redirect('add_questions/'. $task_id);
                return redirect('addQuestion/'.$task_id.'/'. $NoOfQuestns );
                return response()->json(['status' => true, 'message' => "Task added successfully", 'task_id' => $task_id]);
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
                $GetlastId = Task::select('task_id')->where('task_name', $task_name)->get();
                $task_id = $GetlastId[0]->task_id;
                return response()->json(['status' => true, 'message' => "Task updated successfully", 'task_id' => $task_id]);
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
      
        $result = Task::leftjoin('levels','tasks.task_level','=','levels.id')
                        ->select('tasks.*', 'levels.level_name')
                        ->orderby('tasks.created_at', 'asc')
                        ->paginate(10);
                        // ->get();
        
        if($result == true){
           return view('task', ['result' => array($result)]);
           return response()->json(['status' => true, 'message' => "Data retrieved", 'data' => $result]);
        } else {
            return response()->json(['status' => false, 'message' => "Failed to retreive data"]);
        }
    }

    //Get task by id
    public function GetTaskbyId($id){
       if(Task::where('task_id', $id)->exists()){
        $result = Task::where('task_id', $id)->first();

        $questions = Question::select('*')->where('task_id', $id)->get();
    
       if ((!empty($result)) && (!empty($questions))){
       
            return view('task_details', ['data' => array($result), 'question' => ($questions)]);
            return response()->json(['status' => true, 'message' => "Data retreived", 'data' =>  $result , 'questions' => $questions]);
       } else if((!empty($result)) && (empty($questions))){
         
            return view('task_details', ['data' => array($result), 'question' =>array(null)]);
            return response()->json(['status' => false, 'data'=>$result, 'questions'=>null]);
        } else {
            return true;
        }
    }else{
        return response()->json(['status' => false, 'message' => "No such task found"]);
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


// Add questions
public function AddQuestion($id, $limit){
    
    $task_id = $id;

    $noOfquestions = $limit;

    return view('add_Questions', ['task_id' => $task_id, 'questionLimit' => $noOfquestions]);

}
public function SaveQuestions(Request $request, $task_id){

    $noOfquestions = Task::select('question_limit')->where('task_id', $task_id)->get();
    $questionLimit = $noOfquestions[0]->question_limit;
    
    if(! empty($questionLimit)) {
        for ($i=1;$i<=$questionLimit;$i++){
          
            $user = Session::get('user'); 
            $created_by = $user->id;
            $question = $request->question;
            $optionA= $request->OptionA;
            $optionB=$request->OptionB;
            $optionC =$request->OptionC;
            $optionD =$request->OptionD;
            $optionE = $request->OptionE;
            $answer  = $request->answer ;
        
            $result = Question::insert([
                    'task_id' => $task_id,
                    'question' => $question,
                    'optionA' => $optionA,
                    'optionB' => $optionB,
                    'optionC' => $optionC,
                    'optionD' => $optionD,
                    'optionE' => $optionE,
                    'answer' => $answer,
                    'created_by' => $created_by,
                    'created_at' => date('Y-m-d')
            ]);
   
            if($result == true) {
                 $count = $questionLimit - 1;
                
                 if($count != 0){
                    $setLimit = Task::where( 'task_id', $task_id) ->update([
                        'question_limit' => $count
                       ]);
                   
                      return redirect('addQuestion/'.$task_id. '/'.$count);  
                 } else if($count == 0){
                    
                   return redirect('taskDetails');
                 }
            } else {
                return response()->json(['status' => false]);
            }
        }      
    } else {
     return  redirect('taskDetails');
       // return view('/taskDetails');
    }
 
   return  redirect('taskDetails');
   // return response()->json(['status' => true, 'message' => "Questions added successfully", 'qid' => $qid]);
 
}

// Add answers
public function AddAnswers(Request $request, $qid){

    $option1 = $request->option1;
    $option2 = $request->option2;
    $option3 = $request->option3;
    $option4 = $request->option4;
    $option5 = $request->option5;
    $answer = $request->answer;

    $result = Answer::insert([
        'qid' => $qid,
        'option1' => $option1,
        'option2' => $option2,
        'option3' => $option3,
        'option4' => $option4,
        'option5' => $option5,
        'answer' => $answer
    ]);

    if($result == true){
        return response()->json(['status'=>true, 'message'=>"Added answers"]);
    }
    else{
        return response()->json(['status'=>false, 'message'=>"Failed to add"]);
    }
    
}


}