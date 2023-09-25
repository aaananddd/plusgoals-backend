<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Validator;

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
            'created_by' => 'required',
            'token' => 'required',
        ]);

        if($validator->fails()){
            $msg = $validator->messages()->first();
            return response()->json(['response_code' => false, 'message' => $msg]);
        }

        $task_name = $request->task_name;
        $task_desc = $request->task_desc;
        $created_by = $request->created_by;
        $task_level = $request->task_level ? $request->task_level:null;
        $is_active = 1;
        $time_limit = $request->time_limit ? $request->time_limit:null;
        $task_date = $request->task_date ? $request->task_date:null;
        $difficulty_level = $request->difficulty_level ? $request->difficulty_level:null;
        $save_template = $request->save_template ? $request->save_template:null;
        $token = $request->token;

        $result = Task::insert([
            'task_name' => $task_name,
            'task_desc' => $task_desc,
            'created_by' => $created_by,
            'task_level' => $task_level,
            'is_active' => $is_active,
            'time_limit' => $time_limit,
            'task_date' => $task_date,
            'difficulty_level' => $difficulty_level,
            'save_template' => $save_template,
            'created_date' => date('Y-m-d')
        ]);

        if($result == true){
            return response()->json(['status' => true, 'message' => "Task added successfully"]);
        } else {
            return response()->json(['status' => false, ' message' => "Failed to add task"]);
        }
    }

    ///Update Task
    public function UpdateTask(Request $request){
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
            $token = $request->token;
    
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
                return response()->json(['status' => true, 'message' => "Task added successfully"]);
            } else {
                return response()->json(['status' => false, ' message' => "Failed to add task"]);
            }
        } else{
            return response()->json(['status' => false, 'message' => "No such task found"]);
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
    public function GetTaskbyId(Request $request){
        $validator = Validator::make($request->all(),[
            'task_id' => 'required',
        ]);

        if($validator->fails()){
            $msg = $validator->messages()->first();
            return response()->json(['response_code' => false, 'message' => $msg]);
        }
        
        $task_id = $request->task_id;
        $result = Task::where('task_id', $task_id)->first();

        if($result == true){
            return response()->json(['status' => true, 'message' => "Data retreived", 'data' => $result]);
        } else {
            return response()->json(['status' => false, 'message' => "Failed to retreive data"]);
        }
    }
    
    //Delete task
    public function DeleteTask(Request $request){
        $validator = Validator::make($request->all(),[
            'task_name' => 'required',
        ]);

        if($validator->fails()){
            $msg = $validator->messages()->first();
            return response()->json(['response_code' => false, 'message' => $msg]);
        }
        $task_name=$request->task_name;
        $result = Task::where('task_name', $task_name)->delete();

        if($result == true){
            return response()->json(['status' => true, 'message'=>"Deleted task successfully"]);
        }else {
            return response()->json(['status' => false, 'message'=>"Failed to delete"]);
        }
    }
}
