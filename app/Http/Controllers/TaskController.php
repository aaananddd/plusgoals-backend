<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Question;
use App\Models\DifficultyLevel;
use App\Models\Level;
use App\Models\Student;
use App\Models\TaskAttachment;
use App\Models\TaskCategory;
use App\Models\Module;
use App\Models\StudentTask;
use App\Models\RequestForEdit;
use App\Models\StudentDetail;
use App\Models\AdminNotification;
use App\Models\Descriptive;
use App\Models\StudentCategory;
use App\Models\SequentialParent;
use App\Models\ManualCorrection;
use App\Models\Order;
use Validator;
use DB;
use App\Models\AdminTaskAttachment;
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
    public function InsertTask(Request $request)
    {

        $user = Session::get('user');
        $user_id = $user->id;
       
        $TokenCheck = User::where('id', $user_id)->first();
	    $taskDesc = "Task";

	    $task_name = $request->task_name  ?? null ;
        $task_desc = $request->task_desc ??  $taskDesc;
        $task_level = $request->task_level ?? null;
        $is_active = 1;
        $NoOfQuestns = $request->NoOfQuestns ?? null;
        $NofQstnsAns = $request->NofQstnsAns ?? null;
        $difficulty_level = $request->difficulty_level ?? null;
        $time = $request->time;
        $created_by = $user_id;
        $task_type = $request->task_type;
        $task_category = $request->taskCategory;
        $student_category = $request->module;
        $order = $request->order;

        $role = User::select('role')->where('id', $user_id)->first();
        if($role->role == 1){
            $result = Task::insertGetId([
                'task_name' => $task_name,
                'task_desc' => $task_desc,
                'created_by' => $user_id,
                'task_level' => $task_level,
                'is_active' => $is_active,
                'NoOfQuestns' => $NoOfQuestns,
                'NofQstnsAns' => $NofQstnsAns,
                'difficulty_level' => $difficulty_level,
                'save_template' => '1',
                'created_at' => date('Y-m-d'),
                'question_limit' => $NoOfQuestns,
                'course_id' => 1,
                'time' => $time,
                'is_admin_approved' => 1,
                'created_by' => $created_by,
                'task_type' => $task_type,
                'task_category' => $task_category,
                'student_category' => $student_category,
                'order' => $order
            ]);
            if ($result == true) {  
                $task_id = $result;

                if ($request->hasFile('file')) {
                    $files = $request->file('file');
                    foreach ($files as $file) {
                        $filename = $file->getClientOriginalName();
                        $path = $file->storeAs('uploads', $filename, 'public'); // Adjust the storage path as needed

                    $fileModel = AdminTaskAttachment::insert([
                        'task_id' => $task_id,
                        'level_id' => $task_level,
                        'difficulty_id' => $difficulty_level,
                        'file_name' => $filename,
                        'file_path' => $path,
                        'created_at' => date('Y-m-d')
                    ]);
                    }
		        }

                if($NoOfQuestns != null){

                    return redirect('select_task_type/'. $task_id.'/'. $NoOfQuestns);
                    // return redirect('addQuestion/' . $task_id . '/' . $NoOfQuestns);
                    return response()->json(['status' => true, 'message' => "Task added successfully", 'task_id' => $task_id]);
                } else {
                    return redirect('taskDetails');
                    return response()->json(['status' => true, 'message' => "Task added successfully", 'task_id' => $task_id]);
                }
         
            } else {
                return response()->json(['status' => false, ' message' => "Failed to add task"]);
            }
        } else {
            $result = Task::insertGetId([
                'task_name' => $task_name,
                'task_desc' => $task_desc,
                'created_by' => $user_id,
                'task_level' => $task_level,
                'is_active' => $is_active,
                'NoOfQuestns' => $NoOfQuestns,
                'NofQstnsAns' => $NofQstnsAns,
                'difficulty_level' => $difficulty_level,
                'save_template' => '1',
                'created_at' => date('Y-m-d'),
                'question_limit' => $NoOfQuestns,
                'course_id' => 1,
                'time' => $time,
                'is_admin_approved' => 0,
                'created_by' => $created_by,
                'task_type' => $task_type,
                'task_category' => $task_category,
                'student_category' => $student_category,
                'order' => $order

            ]);
            if ($result == true) {  
                $task_id = $result;

		if ($request->hasFile('file')) {
    		$files = $request->file('file');
    		 foreach ($files as $file) {
        		$filename = $file->getClientOriginalName();
        		$path = $file->storeAs('uploads', $filename, 'public'); // Adjust the storage path as needed

        	$fileModel = AdminTaskAttachment::insert([
            	'task_id' => $task_id,
            	'level_id' => $task_level,
            	'difficulty_id' => $difficulty_level,
            	'file_name' => $filename,
            	'file_path' => $path,
            	'created_at' => date('Y-m-d')
        	]);
    		}
		}
                if($NoOfQuestns != null){

                            return redirect('select_task_type/'. $task_id.'/'. $NoOfQuestns);
                            // return redirect('addQuestion/' . $task_id . '/' . $NoOfQuestns);
                            return response()->json(['status' => true, 'message' => "Task added successfully", 'task_id' => $task_id]);
                        } else {
                            return redirect('taskDetails');
                            return response()->json(['status' => true, 'message' => "Task added successfully", 'task_id' => $task_id]);
                        }
                 
         
            } else {
                return response()->json(['status' => false, ' message' => "Failed to add task"]);
            }
        }
    }
  

    //Set sequential order

    public function setSequentialOrder($task_id, $limit){

        $level = Level::select('id', 'level_name')->get();
        $difficulty_level = DifficultyLevel::select('id as difficulty_id', 'level_name as difficulty')->get();
        $task_category = TaskCategory::select('id as category_id', 'category_name')->where('is_active', 1)->get();
        $module = StudentCategory::select('id as module_id', 'category_name as module_name')->where('is_active', 1)->get();

        if($level != null){
            return view('set_sequential_order',['level'=> $level, 'difficulty_level'=> $difficulty_level, 'task_category'=>$task_category,'module'=>$module, 'task_id'=> $task_id, 'limit'=>$limit]);
            return response()->json(['status'=>true, 'message'=>"Data retreived", 'data'=> $tasks], 200);
        } else {
            return response()->json(['status'=>false, 'message'=>"Failed to retreive data"], 422);
        }

    }

    //Get sequential tasks
    public function getSequentialTasks(Request $request){
        $task_id = Session::get('task_id');
        $task_level = $request->task_level ? $request->task_level : null;
        $difficulty_level = $request->difficulty_level ? $request->difficulty_level : null;
        $task_category = $request->task_category ? $request->task_category : null;
        $module = $request->module ? $request->module : null;

        Session::put('task_id', $task_id);
        Session::put('task_level', $task_level);
        Session::put('difficulty_level', $difficulty_level);
        Session::put('task_category', $task_category);
        Session::put('module', $module);
        $tasks = Task::select('*')->where(['is_active'=>1,'task_level'=>$task_level, 'difficulty_level' => $difficulty_level, 
                                            'task_category'=>$task_category,'student_category'=> $module])
                                ->whereNot('task_id', $task_id)
                                ->get();
      
        if($tasks != null){
            return response()->json(['status'=>true, 'message'=> "Data retreived", 'data'=>$tasks], 200);
        } else {
            return response()->json(['status'=>false, 'message'=>"Failed to retreive data", 'data'=> $tasks]);
        }
    
    }
    
    //Insert Short Task
    public function  insertShortTask(Request $request){
    
    $user = Session::get('user');
    $user_id = $user->id;
    $TokenCheck = User::where('id', $user_id)->first();


	$taskDesc = "Task";

	 $task_name = $request->task_name  ?? null ;
        $task_desc = $request->task_desc ??  $taskDesc;
        $task_level = $request->task_level ?? null;
        $is_active = 1;
        $NoOfQuestns = 1;
        $NofQstnsAns = 1;
        $difficulty_level = $request->difficulty_level ?? null;
        $time = $request->has('time') ??  null;
        $created_by = $user_id;
        $task_type = 2;

        $role = User::select('role')->where('id', $user_id)->first();
        if($role->role == 1){
            $result = Task::insertGetId([
                'task_name' => $task_name,
                'task_desc' => $task_desc,
                'created_by' => $user_id,
                'task_level' => $task_level,
                'is_active' => $is_active,
                'NoOfQuestns' => $NoOfQuestns,
                'NofQstnsAns' => $NofQstnsAns,
                'difficulty_level' => $difficulty_level,
                'save_template' => '1',
                'created_at' => date('Y-m-d'),
                'question_limit' => $NoOfQuestns,
                'course_id' => 1,
                'time' => $time,
                'is_admin_approved' => 1,
                'created_by' => $created_by,
                'task_type' => 2
    
            ]);
            if ($result == true) {
       
                $task_id = $result;

                $insertQuestion = Question::insert([
                    'task_id' => $task_id,
                    'question' => null,
                    'a' => null,
                    'b' => null,
                    'c' => null,
                    'd' => null,
                    'e' => null,
                    'answer' => $request->answer,
                    'created_by' => $user_id,
                    'created_at' => now(),
                ]);
		if ($request->hasFile('file')) {
    		$files = $request->file('file');
    			foreach ($files as $file) {
        		$filename = $file->getClientOriginalName();
        		$path = $file->storeAs('uploads', $filename, 'public'); // Adjust the storage path as needed

        	$fileModel = AdminTaskAttachment::insert([
            	'task_id' => $task_id,
            	'level_id' => $task_level,
            	'difficulty_id' => $difficulty_level,
            	'file_name' => $filename,
            	'file_path' => $path,
            	'created_at' => date('Y-m-d')
        	]);
    		}
		}

                return redirect('taskDetails');
                return response()->json(['status' => true, 'message' => "Task added successfully", 'task_id' => $task_id]);
            } else {
                return response()->json(['status' => false, ' message' => "Failed to add task"]);
            }
        } else {
            $result = Task::insertGetId([
                'task_name' => $task_name,
                'task_desc' => $task_desc,
                'created_by' => $user_id,
                'task_level' => $task_level,
                'is_active' => $is_active,
                'NoOfQuestns' => $NoOfQuestns,
                'NofQstnsAns' => $NofQstnsAns,
                'difficulty_level' => $difficulty_level,
                'save_template' => '1',
                'created_at' => date('Y-m-d'),
                'question_limit' => $NoOfQuestns,
                'course_id' => 1,
                'time' => $time,
                'is_admin_approved' => 0,
                'created_by' => $created_by,
                'task_type' => 2

            ]);
            if ($result == true) {
               
                $task_id = $result;
                $insertQuestion = Question::insert([
                    'task_id' => $task_id,
                    'question' => null,
                    'a' => null,
                    'b' => null,
                    'c' => null,
                    'd' => null,
                    'e' => null,
                    'answer' => $request->answer,
                    'created_by' => $user_id,
                    'created_at' => now(),
                ]);
                if ($request->hasFile('file')) {
                    $image = $request->file('file');
                    $filename = $image->getClientOriginalName();
                    $path = $image->storeAs('uploads', $filename, 'public'); // Adjust the storage path as needed

                    $fileModel = AdminTaskAttachment::insert([
                        'task_id' => $task_id,
                        'level_id' => $task_level,
                        'difficulty_id' => $difficulty_level,
                        'file_name' => $filename,
                        'file_path' => $path,
                        'created_at' => date('Y-m-d')
                    ]);
                }
                return redirect('taskDetails');
                return response()->json(['status' => true, 'message' => "Task added successfully", 'task_id' => $task_id]);
            } else {
                return response()->json(['status' => false, ' message' => "Failed to add task"]);
            }
        }
    }

    //List of not approved tasks
    public function TasksPendingForAdminApproval(){
       
        $result = Task::leftjoin('levels', 'tasks.task_level', '=', 'levels.id')
        ->leftjoin('users', 'users.id','=','tasks.created_by')
        ->leftjoin('difficulty_levels', 'tasks.difficulty_level', '=', 'difficulty_levels.id')
        ->select(
            \DB::raw('ROW_NUMBER() OVER (ORDER BY tasks.task_id) as slno'),
            'tasks.task_id',
            'tasks.task_name',
            'tasks.task_desc',
            'tasks.created_by',
            'users.first_name',
            'users.last_name',
            'levels.level_name',
            'tasks.created_at',
            'difficulty_levels.level_name as difficulty'
        )
        ->where('tasks.is_admin_approved', 0)
        ->orderby('tasks.task_id', 'asc')
        ->paginate(10);
    
  
    if ($result->isNotEmpty()) {
        return view('tasks_pending_approval', ['result' => array($result)]);
       //     return response()->json(['status' => true, 'message' => "Data retrieved", 'data' => $result]);
    } else {
        return view('tasks_pending_approval', ['result' => array($result)]);
        // return response()->json(['status' => false, 'message' => "No data", 'data'=> $result]);
    }
    }

    //Task to be approved 
    public function TaskTobeapproved(Request $request, $id){

        if (Task::where('task_id', $id)->exists()) {
          
            $result = Task::where('task_id', $id)->first();
            $Difficultyresult = DifficultyLevel::select('*')->get();
            $levelResult = Level::select('*')->get();
            $questions = Question::select('*')->where('task_id', $id)->get();

            if ((!empty($result)) && (!empty($questions))) {

                return view('approve_tasks', ['data' => array($result), 'question' => ($questions), 'difficultylevel' => $Difficultyresult, 'level' => $levelResult]);
            
            } else if ((!empty($result)) && (empty($questions))) {

                return view('approve_tasks', ['data' => array($result), 'question' => array(null)]);
        
            } else {
                return true;
            }
        } else {
            return response()->json(['status' => false, 'message' => "No such task found"]);
        }
    }

    //Approve Tasks
    public function ApproveTask($task_id){

        $user = Session::get('user');
     
        $user_id = $user->id;
        $is_approved = 1;
        $role = User::select('role')->where(["id" => $user_id])->first();
        if($role->role == 1){
         
            $result  = Task::where("task_id",$task_id)->update([
                'is_admin_approved'  => $is_approved,
            ]);

           
            if($result){
                
                 return response()->json(['status'=>true, 'message'=>"Task approved." ]);
            } else {
            
                return response()->json(['status' =>false, 'message' => "Faild to approve task"]);
            }
        } else {
            return respone()->json(['status'=> false, 'message' => "Oly admin allowed to perform this action"]);
        }
    }

    public function UpdateTask(Request $request, $id)
    {

        $TokenCheck = User::where('id', $user_id)->first();
        $oldtask_id = $id;

        // $DB_token = $TokenCheck->remember_token;
        if ($user_id !== null) {
            $task_name = $request->task_name;
            $task_desc = $request->task_desc;

            $task_level = $request->task_level ? $request->task_level : null;
            $is_active = 1;
            $NoOfQuestns = $request->NoOfQuestns ? $request->NoOfQuestns : null;
            $NofQstnsAns = $request->NofQstnsAns ? $request->NofQstnsAns : null;
            $difficulty_level = $request->difficulty_level ? $request->difficulty_level : null;
            $task_category = $request->taskCategory ? $request->taskCategory : null;
            $module = $request->module ? $request->module : null;
            $time = $request->has('time') ? $request->time : null;
            $order = $request->order;

            $result = Task::insertGetId([
                'task_name' => $task_name,
                'task_desc' => $task_desc,
                'created_by' => $user_id,
                'task_level' => $task_level,
                'is_active' => $is_active,
                'NoOfQuestns' => $NoOfQuestns,
                'NofQstnsAns' => $NofQstnsAns,
                'difficulty_level' => $difficulty_level,
                'save_template' => '1',
                'created_at' => now(),  // Use Laravel helper function now() for current datetime
                'question_limit' => $NoOfQuestns,
                'task_category' => $task_category,
                'student_category' => $module,
                'time' => $time,
                'order' => $order
            ]);

            if ($result != null) {

                //    $GetlastId = Task::select('task_id')->where('task_name', $task_name)->get();
                //    $task_id = $GetlastId[0]->task_id;
                $task_id = $result;
                if ($request->hasFile('file')) {
                    $image = $request->file('file');
                    $filename = $image->getClientOriginalName();
                    $path = $image->storeAs('uploads', $filename, 'public'); // Adjust the storage path as needed

                    $fileModel = AdminTaskAttachment::insert([
                        'task_id' => $task_id,
                        'level_id' => $task_level,
                        'difficulty_id' => $difficulty_level,
                        'file_name' => $filename,
                        'file_path' => $path,
                        'created_at' => date('Y-m-d')
                    ]);
                }
                //    dd($request);
                $currentPage = $request->input('page', 1);

// dd($currentPage);
                return redirect('editQuestion/' . $task_id . '/' . $oldtask_id . '/' . $NoOfQuestns . '/' . $currentPage);
                //    return response()->json(['status' => true, 'message' => "Task added successfully", 'task_id' => $task_id]);
            } else {
                return response()->json(['status' => false, ' message' => "Failed to add task"]);
            }
        } else {
            return response()->json(['status' => false, 'message' => "Invalid token"]);
        }
    }

   public function EditQuestions($id, $limit, $currentQuestion)
{

    if (Task::where('task_id', $id)->exists()) {
        $questions = Question::where('task_id', $id)->pluck('id')->toArray();

      	$NoOfQuestions = Task::select('NoOfQuestns')->where('task_id', $id)->first();
        $limit = $NoOfQuestions->NoOfQuestns;
        
        for($i = $currentQuestion; $i < $limit; $i ++){

            if (!isset($questions[$i])) {
                return redirect('select_task_type/'. $id.'/'. $limit);
            }            
	$questionId = $questions[$i];
               
          //  $question = Question::find($questionId);
          $question = Question::select('*')->where('id',$questionId)->get();

            // Check if the question is found
            if ($question->isEmpty()) {
                     // Question not found, handle accordingly (redirect or show an error)
                return redirect('taskDetails')->with('error', 'Question not found.');
              
            } else {
                if($question[0]->task_type == 1) {
                  
                    return view('edit_questions', [
                        'task_id' => $id,
                        'questionLimit' => $currentQuestion + 1,
                        'question' => $question,
                        'currentQuestion' => $questionId,
                        'currentQuestionId' => $i
                    ]);
                } elseif($question[0]->task_type == 2) {
                   
                    return view('edit_short_task', [
                        'task_id' => $id,
                        'questionLimit' => $currentQuestion + 1,
                        'question' => $question,
                        'currentQuestion' => $questionId,
                        'currentQuestionId' => $i
                    ]);
                } elseif($question[0]->task_type == 3){
                    return view('edit_descriptive', [
                        'task_id' => $id,
                        'questionLimit' => $currentQuestion + 1,
                        'question' => $question,
                        'currentQuestion' => $questionId,
                        'currentQuestionId' => $i
                    ]);
                }
            }
          
	}
    }

    // All questions have been edited or limit reached, redirect or do something else
    return redirect('taskDetails');
}
    
   public function GetTaskbyIdForEdit($id)
    {
       
        if (Task::where('task_id', $id)->exists()) {
             $result = Task::leftjoin('student_categories','tasks.student_category','=','student_categories.id')
                           ->leftjoin('orders','tasks.order','=','orders.id')
			   ->leftjoin('levels','levels.id','=','tasks.task_level')
                           ->leftjoin('task_categories','task_categories.id','=','tasks.task_category')
                           ->leftjoin('users','users.id','=','tasks.created_by')
			   ->leftjoin('difficulty_levels','difficulty_levels.id','=','tasks.difficulty_level')
			   ->select('tasks.task_id','tasks.task_name','tasks.task_desc','levels.level_name','difficulty_levels.level_name as difficulty','tasks.created_at',
				'users.first_name','users.last_name','tasks.NoOfQuestns','tasks.NofQstnsAns','task_categories.category_name','student_categories.category_name as module',
                                'tasks.sort_order','orders.order', 'tasks.time')
                           ->where('tasks.task_id', $id)
                           ->first();

            $Difficultyresult = DifficultyLevel::select('*')->get();
            $levelResult = Level::select('*')->get();
            $module = StudentCategory::select('*')->where('is_active',1)->get();
            $taskCategory = TaskCategory::select('*')->where('is_active', 1)->get();
            $questions = Question::select('*')->where('task_id', $id)->get();
            $taskAttchmentCount = AdminTaskAttachment::where(['task_id'=> $id])->count('*');
            $attachment = AdminTaskAttachment::select('id', 'file_name')->where(['task_id'=> $id])->get();
            $order = Order::select('id','order')->get();
               
            for($i = 0; $i < $taskAttchmentCount; $i++){
                $taskAttachment[$i] = $this->download( $attachment[$i]['id']);

              // Generate a unique download URL for each attachment
                $taskAttachmentUrls[$i] = url('download/' . $attachment[$i]['id']); // Adjust the URL structure as needed

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
           
            if ((!empty($result)) && (!empty($questions))) {

                //  return view('task_details', ['data' => array($result), 'question' => ($questions)]);
                return view('task_edit', ['data' => array($result), 'question' => ($questions), 'difficultylevel' => $Difficultyresult, 'level' => $levelResult, 'attachment'=> $attachmentData, 'taskCategory'=>$taskCategory, 'module'=>$module, 'order'=>$order]);
                //  return response()->json(['status' => true, 'message' => "Data retreived", 'data' =>  $result , 'questions' => $questions]);
            } else if ((!empty($result)) && (empty($questions))) {

                return view('task_edit', ['data' => array($result), 'question' => array(null)]);
                //  return response()->json(['status' => false, 'data'=>$result, 'questions'=>null]);
            } else {
                return true;
            }
        } else {
            return response()->json(['status' => false, 'message' => "No such task found"]);
        }
    }
    



    public function SaveEditQuestions(Request $request, $task_id, $currentlimit, $currentQuestionId)
{

    $limit = Task::where('task_id', $task_id)->pluck('NoOfQuestns')->first();

    $user = Session::get('user');
    $user_id = $user->id;

    // Update the question details with the new information
    $question = $request->question;
    $optionA = $request->OptionA;
    $optionB = $request->OptionB;
    $optionC = $request->OptionC;
    $optionD = $request->OptionD;
    $optionE = $request->OptionE;
    $answer = $request->answer;

    // Insert the updated question
    $result = Question::where(['task_id' => $task_id, 'id' => $currentlimit])->update([
        'task_id' => $task_id,
        'question' => $question,
        'a' => $optionA,
        'b' => $optionB,
        'c' => $optionC,
        'd' => $optionD,
        'e' => $optionE,
        'answer' => $answer,
        'created_by' => $user_id,
      
    ]);

    if ($result !== false) {
   //     $editQuestionCountLimit = Question::where('task_id', $task_id)->count();

        if ($currentQuestionId < $limit) {
            $currentQuestion = $currentQuestionId + 1;
        

                // Redirect to the next question
                return redirect()->route('editQuestion', [
                    'id' => $task_id,
                    'limit' => $limit-1,
                    'currentQuestion' =>  $currentQuestion,
                ]);
            } else {
                // All questions have been edited, redirect or do something else
                return redirect('taskDetails');
            }
      
    } else {
        return redirect('taskDetails');
    }
}

public function SaveEditShortQuestions(Request $request, $task_id, $currentlimit, $currentQuestionId)
{

    $limit = Task::where('task_id', $task_id)->pluck('NoOfQuestns')->first();

    $user = Session::get('user');
    $user_id = $user->id;

    // Update the question details with the new information
    $question = $request->question;
    $optionA = $request->optionA;
    $optionB = $request->optionB;
    $optionC = $request->optionC;
    $optionD = $request->optionD;
    $optionE = $request->optionE;
    $answer = $request->answer;

    // Insert the updated question
    $result = Question::where(['task_id' => $task_id, 'id' => $currentlimit])->update([
        'task_id' => $task_id,
        'question' => $question,
        'a' => $optionA,
        'b' => $optionB,
        'c' => $optionC,
        'd' => $optionD,
        'e' => $optionE,
        'answer' => $answer,
        'created_by' => $user_id,
      
    ]);

    if ($result !== false) {
   //     $editQuestionCountLimit = Question::where('task_id', $task_id)->count();

        if ($currentQuestionId < $limit) {
            $currentQuestion = $currentQuestionId + 1;
        

                // Redirect to the next question
                return redirect()->route('editQuestion', [
                    'id' => $task_id,
                    'limit' => $limit-1,
                    'currentQuestion' =>  $currentQuestion,
                ]);
            } else {
                // All questions have been edited, redirect or do something else
                return redirect('taskDetails');
            }
      
    } else {
        return redirect('taskDetails');
    }
}

//Edit descriptive question
public function SaveEditDescriptives(Request $request, $task_id, $currentlimit, $currentQuestionId)
{

    $limit = Task::where('task_id', $task_id)->pluck('NoOfQuestns')->first();

    $user = Session::get('user');
    $user_id = $user->id;

    // Update the question details with the new information
    $question = $request->question;
    // Insert the updated question
    $result = Question::where(['task_id' => $task_id, 'id' => $currentlimit])->update([
        'task_id' => $task_id,
        'question' => $question,
        'created_by' => $user_id,
      
    ]);

    if ($result !== false) {
 
        if ($currentQuestionId < $limit) {
            $currentQuestion = $currentQuestionId + 1;
  
                return redirect()->route('editQuestion', [
                    'id' => $task_id,
                    'limit' => $limit-1,
                    'currentQuestion' =>  $currentQuestion,
                ]);
            } else {
                // All questions have been edited, redirect or do something else
                return redirect('taskDetails');
            }
      
    } else {
        return redirect('taskDetails');
    }
}

    //Get tasks
    public function GetTask(Request $request)
    {

	// $user = Session::get('user'); 

	// $user_id = $user->id;
	$role = User::select('role')
		      ->where('id', 1)
		      ->first();
    $user_role = $role->role;

    $filter = $request->filter ? $request->filter : null;
  
	if($role->role == 1){
	
        	$result = Task::leftjoin('levels', 'tasks.task_level', '=', 'levels.id')
        		->leftjoin('users', 'users.id','=','tasks.created_by')
        		->leftjoin('difficulty_levels', 'tasks.difficulty_level', '=', 'difficulty_levels.id')
                ->leftjoin('orders','orders.id','=','tasks.order')
        		->select(
            			\DB::raw('ROW_NUMBER() OVER (ORDER BY tasks.task_id) as slno'),
            			'tasks.task_id',
            			'tasks.task_name',
            			'tasks.task_desc',
            			'tasks.created_by',
            			'users.first_name',
            			'users.last_name',
            			'levels.level_name',
            			'tasks.created_at',
            			'difficulty_levels.level_name as difficulty',
				        'tasks.is_admin_approved',
                        'users.role',
                        'tasks.is_active',
                        'orders.order'
        		)
        		->where(['tasks.is_admin_approved'=> 1])
        		->orderby('tasks.task_id', 'asc')
        		->paginate(10);

        $order = Order::select('*')->get();

               if ($result == true) {
            
                return view('task', ['result' => array($result), 'user' => $user_role, 'order' => $order]);

               } else {
            		return response()->json(['status' => false, 'message' => "Failed to retreive data"]);
               }
        } else {
    
                $result = Task::leftjoin('levels', 'tasks.task_level', '=', 'levels.id')
                ->leftjoin('users', 'users.id','=','tasks.created_by')
                ->leftjoin('difficulty_levels', 'tasks.difficulty_level', '=', 'difficulty_levels.id')
                ->select(
                    \DB::raw('ROW_NUMBER() OVER (ORDER BY tasks.task_id) as slno'),
                    'tasks.task_id',
                    'tasks.task_name',
                    'tasks.task_desc',
                    'tasks.created_by',
                    'users.first_name',
                    'users.last_name',
                    'levels.level_name',
                    'tasks.created_at',
                    'difficulty_levels.level_name as difficulty',
                    'tasks.is_admin_approved',
                    'users.role',
                    'orders.order',
                    \DB::raw('(SELECT id FROM request_for_edits WHERE task_id = tasks.task_id AND user_id = tasks.created_by ) as request_sent'),
                    \DB::raw('(SELECT is_admin_approved FROM request_for_edits WHERE task_id = tasks.task_id AND user_id = tasks.created_by ) as is_request_approved')
                )
                ->where(['tasks.created_by'=> $user_id])
                ->orderBy('tasks.task_id', 'asc')
                ->paginate(10);
                
            $order = Order::select('*')->get();
               if ($result == true) {
                // return response()->json(['status' => true, 'message' => "Data retreived", 'data' => $result]);
            		return view('task', ['result' => array($result),'user' => $user_role, 'order'=>$order]);
               } else {
            		return response()->json(['status' => false, 'message' => "Failed to retreive data"]);
               }
	
    	}
    }


    //Get task by id

    public function GetTaskbyId($id)
    {
        if (Task::where('task_id', $id)->exists()) {
            $result = Task::where('task_id', $id)->first();
            $Difficultyresult = DifficultyLevel::select('*')->get();
            $levelResult = Level::select('*')->get();
            $questions = Question::select('*')->where('task_id', $id)->get();
          
            if ((!empty($result)) && (!empty($questions))) {

                //  return view('task_details', ['data' => array($result), 'question' => ($questions)]);
                return view('task_view', ['data' => array($result), 'question' => ($questions), 'difficultylevel' => $Difficultyresult, 'level' => $levelResult]);
                //  return response()->json(['status' => true, 'message' => "Data retreived", 'data' =>  $result , 'questions' => $questions]);
            } else if ((!empty($result)) && (empty($questions))) {

                return view('task_view', ['data' => array($result), 'question' => array(null)]);
                //  return response()->json(['status' => false, 'data'=>$result, 'questions'=>null]);
            } else {
                return true;
            }
        } else {
            return response()->json(['status' => false, 'message' => "No such task found"]);
        }
    }

    //Delete task
    public function DeleteTask( $id)
    {
       
        if (Task::where('task_id', $id)->exists()) {
           
            $questions = Question::select('id')->where('task_id', $id)->get();
            if($questions != null){
                $deleteQuestions = Question::select('id')->where('task_id', $id)->delete();
            } 

            $attachments = AdminTaskAttachment::select('id')->where('task_id', $id)->get();
            if($attachments != null){
                $deleteAttachments = AdminTaskAttachment::select('id')->where('task_id', $id)->delete();
            }

            $result = Task::where('task_id', $id)->delete();

            if ($result == true) {
                return redirect('taskDetails')->with('message', 'Task deleted');

                return response()->json(['status' => true, 'message' => "Deleted task successfully"]);
            } else {
                return response()->json(['status' => false, 'message' => "Failed to delete"]);
            }
        } else {
            return response()->json(['status' => false, 'message' => "No such task found"]);
        }
    }


    // Add questions
    public function AddQuestion($id, $limit)
    {

        $task_id = $id;

        $noOfquestions = $limit;

        return view('add_Questions', ['task_id' => $task_id, 'questionLimit' => $noOfquestions]);

    }

       // Add questions for short answer
       public function AddQuestionforShort($id, $limit)
       {
   
           $task_id = $id;
   
           $noOfquestions = $limit;
   
           return view('short_answer', ['task_id' => $task_id, 'questionLimit' => $noOfquestions]);
   
       }

          // Add questions for short answer
          public function DescriptiveQuestion($id, $limit)
          {
      
              $task_id = $id;
      
              return view('descriptive', ['task_id' => $task_id, 'questionLimit' => $limit]);
      
          }

       public function SaveQuestions(Request $request, $task_id)
    {
        // dd($task_id);
        $noOfquestions = Task::select('question_limit')->where('task_id', $task_id)->get();
        $questionLimit = $noOfquestions[0]->question_limit;
        // dd($questionLimit);

        if (!empty($questionLimit)) {
            for ($i = 1; $i <= $questionLimit; $i++) {

                $user = Session::get('user');
                $created_by = $user->id;
                $question = $request->question;
                $optionA = $request->OptionA;
                $optionB = $request->OptionB;
                $optionC = $request->OptionC;
                $optionD = $request->OptionD;
                $optionE = $request->OptionE;
                $answer = $request->answer;

                $result = Question::insert([
                    'task_id' => $task_id,
                    'question' => $question,
                    'a' => $optionA,
                    'b' => $optionB,
                    'c' => $optionC,
                    'd' => $optionD,
                    'e' => $optionE,
                    'answer' => $answer,
                    'created_by' => $created_by,
                    'created_at' => date('Y-m-d'), 
                    'task_type' => 1
                ]);

                if ($result == true) {
                    $count = $questionLimit - 1;

                    if ($count != 0) {
                        $setLimit = Task::where('task_id', $task_id)->update([
                            'question_limit' => $count
                        ]);

                        return redirect('select_task_type/'. $task_id.'/'. $count);
                        // return redirect('addQuestion/' . $task_id . '/' . $count);
                    } else if ($count == 0) {

                        return redirect('taskDetails');
                    }
                } else {
                    return response()->json(['status' => false]);
                }
            }
        } else {
            return redirect('taskDetails');
            // return view('/taskDetails');
        }

        return redirect('taskDetails');
        // return response()->json(['status' => true, 'message' => "Questions added successfully", 'qid' => $qid]);

    }

    public function SaveShortQuestions(Request $request, $task_id)
    {
         
        $noOfquestions = Task::select('question_limit')->where('task_id', $task_id)->get();
        $questionLimit = $noOfquestions[0]->question_limit;
        // dd($questionLimit);

        if (!empty($questionLimit)) {
            for ($i = 1; $i <= $questionLimit; $i++) {

                $user = Session::get('user');
                $created_by = $user->id;
                $question = $request->question;
                $optionA = $request->optionA ? $request->optionA : null;
                $optionB = $request->optionB ? $request->optionB : null;
                $optionC = $request->optionC ? $request->optionC : null;
                $optionD = $request->optionD ? $request->optionD : null;
                $optionE = null;
                $answer = null;

                $result = Question::insert([
                    'task_id' => $task_id,
                    'question' => $question,
                    'a' => $optionA,
                    'b' => $optionB,
                    'c' => $optionC,
                    'd' => $optionD,
                    'e' => $optionE,
                    'answer' => $answer,
                    'created_by' => $created_by,
                    'created_at' => date('Y-m-d'),
                    'task_type' => 2
                ]);

                $taskType = Task::where('task_id',$task_id)->update(['task_type' => 2]);

                if ($result == true) {
                    $count = $questionLimit - 1;

                    if ($count != 0) {
                        $setLimit = Task::where('task_id', $task_id)->update([
                            'question_limit' => $count
                        ]);

                        return redirect('select_task_type/'. $task_id.'/'. $count);
                        // return redirect('addQuestion/' . $task_id . '/' . $count);
                    } else if ($count == 0) {

                        return redirect('taskDetails');
                    }
                } else {
                    return response()->json(['status' => false]);
                }
            }
        } else {
            return redirect('taskDetails');
            // return view('/taskDetails');
        }

        return redirect('taskDetails');
        // return response()->json(['status' => true, 'message' => "Questions added successfully", 'qid' => $qid]);

    }

    // Add answers
    public function AddAnswers(Request $request, $qid)
    {

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

        if ($result == true) {
            return response()->json(['status' => true, 'message' => "Added answers"]);
        } else {
            return response()->json(['status' => false, 'message' => "Failed to add"]);
        }

    }

    public function GetTaskView($id)
    {
        if (Task::where('task_id', $id)->exists()) {

                $result = Task::leftjoin('levels','levels.id','=','tasks.task_level')
                                ->leftjoin('difficulty_levels','difficulty_levels.id','=','tasks.difficulty_level')
                                ->leftjoin('student_categories','student_categories.id','=','tasks.student_category')
                                ->leftjoin('task_categories','task_categories.id','=','tasks.task_category')
                                ->select('tasks.task_id', 'tasks.task_name','tasks.task_desc','levels.level_name','difficulty_levels.level_name as difficulty','student_categories.category_name as student_category','student_categories.id as moduleId','task_categories.category_name')
                                ->where('tasks.task_id', $id)->first();
   
                $taskAttchmentCount = AdminTaskAttachment::where(['task_id'=> $id])->count('*');
             
                $attachment = AdminTaskAttachment::select('id', 'file_name')->where(['task_id'=> $id])->get();
               
                for($i = 0; $i < $taskAttchmentCount; $i++){
                    $taskAttachment[$i] = $this->download( $attachment[$i]['id']);
    
                  // Generate a unique download URL for each attachment
                    $taskAttachmentUrls[$i] = url('download/' . $attachment[$i]['id']); // Adjust the URL structure as needed
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
                
                $questions = Question::select('*')->where('task_id', $id)->get();
                $parents = [];
                $module_id = $result['moduleId'];
             
                $fetchParents = function ($moduleId) use (&$fetchParents) {
                $parent = StudentCategory::select('parent_id')->where('id', $moduleId)->first();
            
                    if ($parent && $parent->parent_id !== null) {

                        $parentModule = StudentCategory::select('id', 'category_name')->where('id', $parent->parent_id)->first();

                        if ($parentModule) {

                            return array_merge([$parentModule], $fetchParents($parent->parent_id));
                        }
                    }
                    return [];
                };
              
                $parents = $fetchParents($module_id);
          
                $result['parent'] = $parents;

                $taskDetails = Task::select('task_level', 'difficulty_level')->where('task_id', $id)->first();
                $level_id = $taskDetails->task_level;
                $difficulty_id = $taskDetails->difficulty_level;
                $sequential_order = $this->getSequentialOrder($id, $level_id, $difficulty_id);
                
                $sequential = json_decode(json_encode($sequential_order), true);
                $result['sequential'] = $sequential;

                if ((!empty($result)) && (!empty($questions))) {
    
                    return view('task_view_new', ['data' => array($result), 'question' => ($questions), 'attachment' => $attachmentData]);
                    // return response()->json(['status' => true, 'message' => "Data retreived", 'data' =>  $result , 'questions' => $questions, 'attachment' => $attachmentData]);
                } else if ((!empty($result)) && (empty($questions))) {
    
                    return view('task_details', ['data' => array($result), 'question' => array(null)]);
                    //  return response()->json(['status' => false, 'data'=>$result, 'questions'=>null]);
                } else {
                    return true;
                }
        //     } elseif ($type->task_type == 2){
              
        //         $result = Task::where('task_id', $id)->first();

        //         $questions = Question::select('answer')->where('task_id', $id)->get();
        
        //         $taskAttchmentCount = AdminTaskAttachment::where(['task_id'=> $id])->count('*');
                
        //         $attachment = AdminTaskAttachment::select('id', 'file_name')->where(['task_id'=> $id])->get();
                
        //         for($i = 0; $i < $taskAttchmentCount; $i++){
        //             $taskAttachment[$i] = $this->download( $attachment[$i]['id']);
        //         // Generate a unique download URL for each attachment
        //             $taskAttachmentUrls[$i] = url('download/' . $attachment[$i]['id']); // Adjust the URL structure as needed
        //         }

        //         // Create an array to hold the attachment data with download links
        //         $attachmentData = [];

        //         // Populate the attachment data array with the necessary information
        //         for ($i = 0; $i < $taskAttchmentCount; $i++) {
        //             $attachmentData[$i] = [
        //                 'id' => $attachment[$i]['id'],
        //                 'file_name' => $attachment[$i]['file_name'],
        //                 'download_link' => $taskAttachmentUrls[$i],
        //             // Add more fields if needed
        //             ];
        //         }



        //         if (!empty($result)) {

        //             return view('short_task_view', ['data' => array($result), 'question' => ($questions), 'attachment' => $attachmentData]);
        //             // return response()->json(['status' => true, 'message' => "Data retreived", 'data' =>  $result , 'questions' => $questions, 'attachment' => $attachmentData]);
        //         } else {
        //             return true;
        //         }
        // }
        } else {
            return response()->json(['status' => false, 'message' => "No such task found"]);
        }
    }

    //Count how amny times a particular task has been assigned 
    public function CountAssignedTasks(){

        $result = StudentTask::leftJoin('tasks', 'tasks.task_id', '=', 'student_tasks.task_id')
                                ->leftJoin('users', 'users.id', '=', 'tasks.created_by')
                                ->leftjoin('levels','levels.id','=','student_tasks.level_id')
                                ->leftjoin('difficulty_levels','difficulty_levels.id','=','student_tasks.difficulty_id')
                                ->select('student_tasks.task_id','tasks.task_name', DB::raw('count(*) as task_count'), 'users.first_name','levels.level_name','difficulty_levels.level_name as difficulty_level')
                                ->groupBy('student_tasks.task_id', 'tasks.task_name','users.first_name','levels.level_name','difficulty_levels.level_name')
                                ->orderByDesc('task_count')
                                ->where('tasks.is_active', 1)
                                ->get();
   

        if($result){ 
            return view('frequent_tasks', ['result' => array($result)]);
            // return response()->json(['status'=>true, 'message'=>"Data retreived", 'data'=>$result]);
        } else {
            return view('frequent_tasks', ['result' => array($result)]);
           // return response()->json(['status'=>false, 'message'=>"Failed to retreive data", 'data'=>$result]);
        }
    }

    //get completed task view of student
    public function completed_task_view(Request $request, $task_id, $student_id){
       
         
    if(Student::where('id', $student_id)->exists()){
 
	if(Task::where('task_id', $task_id)->exists()) {
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
        	return view('completed_task_view', ['result' => array($result)]);
        	return response()->json(['status'=>true, 'message'=>"Data retrieved", 'data'=> $result]);
	} else {

		return view('no_task');
        }
	
  } else {
    return response()->json(['status'=>False, 'message'=>"No such student found"]);
}
    }


public function download($id){
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


public function downloadOld($id)
{
   $file = AdminTaskAttachment::find($id);

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

//Select task type
 public function selectTaskType(Request $request, $task_id, $limit){

        return view('select_task_type', ['task_id' => $task_id, 'limit' => $limit]);
 }
 public function editTask(Request $request, $id){
    
        $user_id = Session::get('user');
        $TokenCheck = User::where('id', $user_id)->first();
    
        $taskDetails = Task::select('*')->where('task_id', $id)->get();
                $task_name = $request->task_name ? $request->task_name : $taskDetails[0]->task_name;
                $task_desc = $request->task_desc ? $request->task_desc : $taskDetails[0]->task_desc; 
                $task_level = $request->task_level ? $request->task_level : $taskDetails[0]->task_level;  
                $is_active = 1;
                $NoOfQuestns = $request->NoOfQuestns ? $request->NoOfQuestns : $taskDetails[0]->NoOfQuestns ;
                $NofQstnsAns = $request->NofQstnsAns ? $request->NofQstnsAns : $taskDetails[0]->NofQstnsAns;
                $difficulty_level = $request->difficulty_level ? $request->difficulty_level : $taskDetails[0]->difficulty_level;
                $save_template = 1;
                $created_at = now();
                $taskCategory = $request->taskCategory ? $request->taskCategory : $taskDetails[0]->taskCategory;
                $module = $request->module ? $request->module : $taskDetails[0]->module;
                $time = $request->time ? $request->time : $taskDetails[0]->time;
                $order = $request->order ? $request->order : $taskDetails[0]->order;
    

            $taskupdate = Task::where('task_id',$id)->first();
            // dd($taskupdate);
            $task = Task::where('task_id',$id)->update([
                'task_name' => $task_name,
                'task_desc' => $task_desc,
                'task_level' => $task_level,
                'NoOfQuestns' => $NoOfQuestns,
                'NofQstnsAns' => $NofQstnsAns,
                'difficulty_level' => $difficulty_level,
                'task_category' => $taskCategory,
                'student_category' => $module,
                'order' => $order,
                'time' => $time,
                'updated_at'=>now()
            ]);
           
                $task_id = $taskupdate->task_id;
                // dd($task_id);

            if ($request->hasFile('file')) {
               
                $files = $request->file('file');
                
                foreach ($files as $file) {
                    $filename = $file->getClientOriginalName();
                    $path = $file->store('uploads', 'public'); // Adjust the storage path as needed

                    $fileModel = AdminTaskAttachment::insert([
                        'task_id' => $task_id,
                        'level_id' => $task_level,
                        'difficulty_id' => $difficulty_level,
                        'file_name' => $filename,
                        'file_path' => $path,
                        'created_at' => date('Y-m-d')
                    ]);
                }
            } 
  
                $currentPage = $request->input('page', 0);
   
                return redirect('editQuestion/' . $task_id .  '/' . $taskupdate->NoOfQuestns .'/'.$currentPage);
            
    }

//Delete upload file

public function deleteFile($id){

    if(AdminTaskAttachment::where('id', $id)->exists()){

        $result =  AdminTaskAttachment::where('id', $id)->delete();
    
      
        if($result === true){

            return response()->json(['status' => true, 'message' => "File deleted"]);
        } else {
            return response()->json(['status'=>false, 'message' => "Failed to delete file"]);
        }
    } else {
        return response()->json(['status'=>false, 'message'=>"No such file exists"]);
    }
}

    //Request to edit
    public function RequestToEdit($task_id, $user_id){

        $insertIntoTable = RequestForEdit::insertGetId([
                'task_id' => $task_id,
                'user_id' => $user_id,
                'is_admin_approved' => 0,
                'created_at' => date("Y-m-d"),
                
        ]);
        if ($insertIntoTable) {

            $result = AdminNotification::insert([
                'notification_text' => "Request for edit",
                'user_id' => $user_id,
                'task_id' => $task_id,
                'notification_type' => 1,
                'request_id' => $insertIntoTable,
                'is_approved' => 0,
                'created_at' => date("Y-m-d")
            ]);
            if($result == true){
                return response()->json(['status'=>true,'message'=>"Your request has been sent successfully"]);
            } else {
                return response()->json(['status'=>false, 'message'=>"Failed to send request"]);
            }
        } else {
            return response()->json(['status'=>false,'message'=>"Something went wrong"]);
        }

    }

    public function RequestForEdit($task_id){

        $result = RequestForEdit::leftjoin('tasks', 'tasks.task_id','=', 'request_for_edits.task_id')
                                ->leftjoin('users','users.id','=','tasks.created_by')
                                ->leftjoin('levels','levels.id','=','tasks.task_level')
                                ->leftjoin('difficulty_levels','difficulty_levels.id','=','tasks.difficulty_level')
                                ->select('request_for_edits.id as request_id','tasks.task_id', 'tasks.task_name', 'tasks.task_desc','levels.level_name','difficulty_levels.level_name as difficulty','users.first_name','users.last_name',
                                    'request_for_edits.created_at','request_for_edits.is_admin_approved')
                                ->where('request_for_edits.task_id' , $task_id)
                                ->get();

        $result[0]['questions'] = RequestForEdit::leftjoin('questions','questions.task_id','=','request_for_edits.task_id')
                                    ->select('questions.id','questions.question','questions.answer','questions.a','questions.b','questions.c','questions.d','questions.e')
                                    ->where('questions.task_id', $task_id)
                                    ->get();

        $result[0]['task_assigned'] = StudentDetail::leftjoin('request_for_edits', 'request_for_edits.task_id','=','student_details.task_id')
                                                    ->select('student_details.id')
                                                    ->where(['student_details.task_id' => $task_id, 'student_details.level_status' => "Pending"])
                                                    ->count();
                                                   
        if(!empty($result)){
            
            return view('request_for_edit',['data' => array($result)]);
            return response()->json(['status'=>true, 'message' =>"Data retreived", 'data' =>$result]);
        } else {
            return response()->json(['status' =>false, 'message' =>"Failed to retreive data"]);
        }
    }

    //Approve request for edit
    public function ApproveRequestForEdit($request_id){

        $result = RequestForEdit::where('id', $request_id)->update([
                    'is_admin_approved' => 1
                ]);

        if($result == true){

            $admin_notification = AdminNotification::where('request_id', $request_id)->update(['is_approved' => 1]);
            
            return response()->json(['status' =>true, 'message'=>"Approved"]);
        } else {
            return response()->json(['status'=>false, 'message'=>"Failed to approve"]);
        }

    }

    //Enable and disable task
    public function Toggle($task_id){
        
        if(Task::where('task_id', $task_id)->exists()){
            
             $toggle = Task::select('is_active')->where('task_id', $task_id)->first();

             if($toggle->is_active == 1){
                $result = Task::where('task_id', $task_id)->update(['is_active' => 0]);
                if($result == true){
                    return redirect('taskDetails')->with('message', 'Task disabled');;
                    return response()->json(['status'=>true, 'message'=>"Task disabled"], 200);
                } else {
                    return response()->json(['status'=>false, 'message'=>"Failed to disable task"], 200);
                }
             } else {
                $result = Task::where('task_id', $task_id)->update(['is_active' => 1]);
                if($result == true){
                    return redirect('taskDetails')->with('message', 'Task enabled');;
                    return response()->json(['status'=>true, 'message'=>"Task enabled"], 200);
                } else {
                    return response()->json(['status'=>false, 'message'=>"Failed to enable task"], 200);
                }
             }

        } else {
            return response()->json(['status'=>false, 'message'=>"Task doesnt exists"], 400);
        }
        
    }

    // save desriptive quesion
    public function saveDescriptive(Request $request, $task_id){

        $question = $request->question;
        $answer = $request->answer;
        $user = Session::get('user');
        $created_by = $user->id;
        $noOfquestions = Task::select('question_limit')->where('task_id', $task_id)->get();
        $questionLimit = $noOfquestions[0]->question_limit;

        $result = Question::insert([
                'task_id' => $task_id,
                'question' => $question,
                'answer' => $answer,
                'task_type' => 3,
                'created_by' => $created_by,
                'created_at' => date('Y-m-d')
        ]);

        $taskType = Task::where('task_id', $task_id)->update(['task_type' => 3]);

        if($result == true){
            $count = $questionLimit - 1;

            if ($count != 0) {
                $setLimit = Task::where('task_id', $task_id)->update([
                    'question_limit' => $count
                ]);

                return redirect('select_task_type/'. $task_id.'/'. $count);
                // return redirect('addQuestion/' . $task_id . '/' . $count);
            } else if ($count == 0) {

                return redirect('taskDetails');
            }
            return response()->json(['status'=>true, 'message' => "Added descriptive task"], 200);
        } else {
            return redirect('taskDetails');
            return response()->json(['status'=>false, 'message' =>"Failed to add descriptive task"], 200);
        }

    }
   
    // date filter
 public function datefilter(Request $request)
 {

    $user = Session::get('user'); 
	$user_id = $user->id;
	
	$role = User::select('role')
		      ->where('id', $user_id)
		      ->first();
    $user_role = $role->role;

	
     $result = Task::orderBy('task_id', 'desc')
         ->when(
             $request->date_from && $request->date_to,
             function ($query) use ($request) {
                 $query->whereBetween(DB::raw('DATE(created_at)'), [
                     $request->date_from,
                     $request->date_to
                 ]);
             }
         )->paginate(5);

     return view('task', ['result' => array($result), 'user' => $user_role]);
 }



 //Set Sequential Parent
 public function setSequentialParent(Request $request, $task_id){

    $parent_task_id = $task_id;
    $child_task_id = $request->child_task;
    $level = Session::get('task_level');
    $difficulty_level = Session::get('difficulty_level');
    $task_category = Session::get('task_category');
    $module = Session::get('module');

    $result = SequentialParent::insert([
        'child_task_id' => $child_task_id,
        'parent_task_id' => $parent_task_id,
        'level_id' => $level,
        'difficulty_id' => $difficulty_level,
        'task_category' => $task_category,
        'module'=> $module,
        'created_at' => date('Y-m-d'),
    ]);

    if($result = true){
        
        return response()->json(['status'=>true, 'message'=>"Added to sequential order"], 200);
    } else {
        return response()->json(['status'=>false, 'message'=>"Failed to add to sequential order"], 422);
    }
 }

 //Set sort order
 public function setSortOrder(Request $request){

    
    $level = Level::select('id', 'level_name')->get();
    $difficulty_level = DifficultyLevel::select('id as difficulty_id', 'level_name as difficulty')->get();
    $task_category = TaskCategory::select('id as category_id', 'category_name')->where('is_active', 1)->get();
    $module = StudentCategory::select('id as module_id', 'category_name as module_name')->where('is_active', 1)->get();

    if($level != null){
        return view('set_sort_data',['level'=> $level, 'difficulty_level'=> $difficulty_level, 'task_category'=>$task_category,'module'=>$module]);
        return response()->json(['status'=>true, 'message'=>"Data retreived", 'data'=> $tasks], 200);
    } else {
        return response()->json(['status'=>false, 'message'=>"Failed to retreive data"], 422);
    }
 }

 //Get tasks for sorting
 public function GetTasksForSorting(Request $request){

    $task_level = $request->task_level;
    $difficulty_level = $request->difficulty_level;

    $result =  Task::leftjoin('levels', 'tasks.task_level', '=', 'levels.id')
                    ->leftjoin('users', 'users.id','=','tasks.created_by')
                    ->leftjoin('difficulty_levels', 'tasks.difficulty_level', '=', 'difficulty_levels.id')
                    ->select(
                            \DB::raw('ROW_NUMBER() OVER (ORDER BY tasks.task_id) as slno'),
                            'tasks.task_id',
                            'tasks.task_name',
                            'tasks.task_desc',
                            'tasks.created_by',
                            'users.first_name',
                            'users.last_name',
                            'levels.level_name',
                            'tasks.created_at',
                            'difficulty_levels.level_name as difficulty',
                            'tasks.is_admin_approved',
                            'users.role',
                            'tasks.is_active',
                            'tasks.NoOfQuestns',
                            'tasks.time'
                    )
                    ->where(['tasks.is_admin_approved'=> 1, 'tasks.order'=> 2, 'tasks.task_level' => $task_level,'tasks.difficulty_level'=>$difficulty_level])
                    ->orderby('tasks.task_id', 'asc')
                    ->paginate(10);

        if($result != null){
            return response()->json(['status'=>true, 'message'=>"Data retreived", 'data'=>$result], 200);
        } else {
            return response()->json(['status'=>false, 'message'=>"Data not retreived", 'data'=>$result], 200);
        }
    }

    //Update sort order
    public function updateOrder(Request $request)
    {
        $order = $request->input('order');

        // Update the sort_order field for each task
        foreach ($order as $index => $taskId) {
            Task::where('task_id', $taskId)->update(['sort_order' => $index + 1]);
        }

        return response()->json(['status' => 'success']);
    }

    //Get sequential order
   public function getSequentialOrder($task_id, $level_id, $difficulty_id)
{
    // Find the sort_order of the given task_id
    $currentTask = DB::table('tasks')
        ->where('task_id', $task_id)
        ->where('task_level', $level_id)
        ->where('difficulty_level', $difficulty_id)
        ->first();

    if (!$currentTask) {
        return "Task not found";
    }

    $sortOrder = $currentTask->sort_order;

    // Initialize $tasks to avoid returning an undefined variable
    $tasks = collect();

    if ($sortOrder !== null) {
        $tasks = DB::table('tasks')
            ->where('task_level', $level_id)
            ->where('difficulty_level', $difficulty_id)
            ->where(function ($query) use ($sortOrder) {
                $query->where('sort_order', '<=', $sortOrder)
                      ->orWhere('sort_order', '>', $sortOrder);
            })
            ->orderBy('sort_order', 'asc')
            ->get();
    }

    return $tasks;
}
    public function showSequentialOrder($task_id)
        {
            $taskDetails = Task::select('task_level', 'difficulty_level')->where('task_id', $task_id)->first();
            $level_id = $taskDetails->task_level;
            $difficulty_id = $taskDetails->difficulty_level;
            $tasks = $this->getSequentialOrder($task_id, $level_id, $difficulty_id);

            return $tasks;
        }

        //Get descriptive question and answer to instructor for manual correction
 public function GetDescriptiveAnswer(Request $request){

    $user = Session::get('user');
    
    if($user->role == 1){
        $result = ManualCorrection::leftjoin('tasks','tasks.task_id','=','manual_corrections.task_id')
                                ->leftjoin('students','students.id','=','manual_corrections.intern_id')
                                ->leftjoin('users','tasks.created_by','=','users.id')
                                ->leftjoin('student_details', 'student_details.student_id','=','students.id')
                                ->leftjoin('levels','student_details.level_id','=','levels.id')
                                ->select('manual_corrections.id','tasks.task_id','tasks.task_name','students.first_name as intern_first_name','students.last_name as intern_last_name',
                                        'manual_corrections.created_at','users.first_name','users.last_name','manual_corrections.approve','levels.level_name')
                            //    ->where('tasks.created_by', $user->id) 
                                ->get();
                             
        if($result != null){
            return view('manual_correction',['data' => $result]);
            return response()->json(['status'=>true, 'message'=>"Data retreived", 'data'=>$result], 200);
        } else {
            return response()->json(['status'=>false, 'message'=>"Failed to retreive data", 'data'=>$result], 422);
        }
                        
    } else {
        $result = ManualCorrection::leftjoin('tasks','tasks.task_id','=','manual_corrections.task_id')
                               ->leftjoin('students','students.id','=','manual_corrections.intern_id')
                               ->leftjoin('users','tasks.created_by','=','users.id')
                               ->leftjoin('student_details', 'student_details.student_id','=','students.id')
                               ->leftjoin('levels','student_details.level_id','=','levels.id')
                               ->select('manual_corrections.id','tasks.task_id','tasks.task_name','students.first_name as intern_first_name','students.last_name as intern_last_name',
                                        'manual_corrections.created_at','users.first_name','users.last_name','manual_corrections.approve','levels.level_name')
                               ->where('tasks.created_by', $user->id) 
                                ->get();
    
        if($result != null){
            return view('manual_correction',['data' => $result]);
            return response()->json(['status'=>true, 'message'=>"Data retreived", 'data'=>$result], 200);
        } else {
            return response()->json(['status'=>false, 'message'=>"Failed to retreive data", 'data'=>$result], 422);
        }
                            
    }
    
}

//Get descriptive anwsers by id
public function GetDescriptiveById(Request $request, $id){

    $user = Session::get('user');
    if($user->role == 1){
        $result = ManualCorrection::leftjoin('tasks','tasks.task_id','=','manual_corrections.task_id')
                                ->leftjoin('students','students.id','=','manual_corrections.intern_id')
                                ->leftjoin('users','tasks.created_by','=','users.id')
                                ->leftjoin('student_details', 'student_details.student_id','=','students.id')
                                ->leftjoin('levels','student_details.level_id','=','levels.id')
                                ->leftjoin('difficulty_levels','student_details.difficulty_level','=','difficulty_levels.id')
                                ->leftjoin('questions','questions.task_id','=','tasks.task_id')
                                ->leftjoin('task_categories','task_categories.id','=','tasks.task_category')
                                ->leftjoin('student_categories','student_categories.id','=','tasks.student_category')
                                ->select('manual_corrections.id','tasks.task_id','tasks.task_name','tasks.task_desc','students.first_name as intern_first_name','students.last_name as intern_last_name',
                                        'manual_corrections.created_at','questions.question','manual_corrections.answer','users.first_name','users.last_name','manual_corrections.approve','levels.level_name',
                                        'difficulty_levels.level_name as difficulty','task_categories.category_name','student_categories.category_name as module')
                                ->where('manual_corrections.id', $id) 
                                ->get();
                             
        if($result != null){
            return view('manual_correction_by_id',['data' => $result]);
            return response()->json(['status'=>true, 'message'=>"Data retreived", 'data'=>$result], 200);
        } else {
            return response()->json(['status'=>false, 'message'=>"Failed to retreive data", 'data'=>$result], 422);
        }
                        
    } else {
        $result = ManualCorrection::leftjoin('tasks','tasks.task_id','=','manual_corrections.task_id')
                                ->leftjoin('students','students.id','=','manual_corrections.intern_id')
                                ->leftjoin('users','tasks.created_by','=','users.id')
                                ->leftjoin('student_details', 'student_details.student_id','=','students.id')
                                ->leftjoin('levels','student_details.level_id','=','levels.id')
                                ->leftjoin('difficulty_levels','student_details.difficulty_level','=','difficulty_levels.id')
                                ->leftjoin('questions','questions.task_id','=','tasks.task_id')
                                ->leftjoin('task_categories','task_categories.id','=','tasks.task_category')
                                ->leftjoin('student_categories','student_categories.id','=','tasks.student_category')
                                ->select('manual_corrections.id','tasks.task_id','tasks.task_name','tasks.task_desc','students.first_name as intern_first_name','students.last_name as intern_last_name',
                                        'manual_corrections.created_at','questions.question','manual_corrections.answer','users.first_name','users.last_name','manual_corrections.approve','levels.level_name',
                                        'difficulty_levels.level_name as difficulty','task_categories.category_name','student_categories.category_name as module')
                                ->where(['manual_corrections.id'=> $id, 'tasks.created_by' => 'tasks.task_id']) 
                                ->get();
            
        if($result != null){
            return view('manual_correction_by_id',['data' => $result]);
            return response()->json(['status'=>true, 'message'=>"Data retreived", 'data'=>$result], 200);
        } else {
            return response()->json(['status'=>false, 'message'=>"Failed to retreive data", 'data'=>$result], 422);
        }
                            
    }
}

//Approve descriptive answer
public function ApproveDescritpive(Request $request, $id){

    $approve = $request->approve;

        if(ManualCorrection::where('id', $id)->exists()){

            $approval = ManualCorrection::select('approve')->where('id', $id)->first();
            if($approval->approve == 1){
                $result = ManualCorrection::where('id', $id)->update([
                    'approve' => 0
                ]);    

                if($result = true){
                    return response()->json(['status'=>true, 'message'=>"Status updated", 'data'=>$result]);
                } else {
                    return response()->json(['status'=>false, 'message'=>"Failed to update status"]);
                }
            } else {
                $result = ManualCorrection::where('id', $id)->update([
                    'approve' => 1
                ]);    

                if($result = true){
                    return response()->json(['status'=>true, 'message'=>"Status updated", 'data'=>$result]);
                } else {
                    return response()->json(['status'=>false, 'message'=>"Failed to update status"]);
                }
            }
        } else {
            $result = ManualCorrection::where('id', $id)->update([
                'approve' => $approve
            ]);
            
        
            if($result = true){
                return response()->json(['status'=>true, 'message'=>"Status updated"], 200);
            } else {
                return response()->json(['status'=>false, 'message'=>"Failed to update status"], 422);
            }
        }
    }


}