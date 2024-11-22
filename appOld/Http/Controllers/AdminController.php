<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Level;
use App\Models\Student;
use App\Models\StudentDetail;
use App\Models\AdminNotification;
use App\Models\RequestForEdit;
use App\Models\TaskCategory;
use App\Models\StudentCategory;
use App\Models\Employee;
use App\Models\RequestForInternContact;
use App\Models\Topic;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Session;
use Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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

            return response()->json(['response_code' => 0, 'message' => $msg]);
        }

        $user_id = $request->user_id;
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $address1 = $request->address1;
        $address2 = $request->address2;
        $city = $request->city;
        $district = $request->district;
        $state = $request->state;
        $country = $request->country;
        $phone = $request->phone;
        // $user_access_token  = $request->token ? $request->token : null;

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
            'phone' => $phone
        ]);


        return response()->json(['status' => 1, 'message' => "Updated user details successfully"]);
    }

    public function teachersList()
    {
    	$teachers = User::leftjoin('levels','levels.id','=','users.level_id')
	->select('users.*', 'levels.level_name')
        ->orderBy('users.id', 'desc')
        ->where(['users.is_active'=> 1, 'users.role'=>2])
        ->get();
     
	if($teachers != Null) {
        $teachersId = User::where('role', '2')->orderBy('id', 'asc')->pluck('id')->toArray();
               return view('teachers_list', ['data' => array($teachers), 'teachersId' => $teachersId]);
      } else {
	  return view('teachers_list', ['data' => array($teachers), 'teachersId' => $teachersId]);
	}
    }


    public function GetTeacherbyId($id)
    {

        if (User::where('id', $id)->exists()) {
            $result = User::where('id', $id)->first();

            if ($result != null) {
           
               return view('teachers_view', ['data' => array($result)]);

            } else {
                return response()->json(['status' => false, 'message' => "Failed to retreive"]);
            }
        } else {
            return response()->json(['status' => false, 'message' => "No such user found"]);
        }
    }

 
    public function EditTeacher($id)
    {
        //    dd($id);
        $response = User::findOrFail($id);
        $result = Level::select('*')->get();
        // dd($result);
        return view('edit_users', ['data' => array($response), 'level' => $result]);

    }

    public function updateTeacher(Request $request, $id)
    {
        if (User::where('id', $id)->exists()) {
            $user = User::find($id);

            if ($user != null) {
                $user->first_name = $request->input('first_name', $user->first_name);
                $user->last_name = $request->input('last_name', $user->last_name);
                $user->email = $request->input('email', $user->email);
                $user->phone = $request->input('phone', $user->phone);
                $user->level = $request->input('level', $user->level);
                $user->is_active = 1; // Assuming this is a boolean field

                $user->save();

                $response = User::select('*')->where('id', $id)->first(); // Using first() instead of get() since we only need one user
                // dd($response);
                return view('teachers_view', ['data' => array($response)]);
                // return response()->json(['status' => true, 'message' => "User updated successfully", 'data' => $response]);
            } else {
                return response()->json(['status' => false, 'message' => "No such user exists"]);
            }
        } else {
            return response()->json(['status' => false, 'message' => "No such user exists"]);
        }
    }

    public function DeleteTeacher($id)
    {
        if (User::where('id', $id)->exists()) {
            $user = User::find($id);

            if ($user != null) {

                $user->is_active = 0; // Assuming this is a boolean field

                $user->save();

                $response = User::select('*')->where('id', $id)->first(); // Using first() instead of get() since we only need one user
                // dd($response);
                return redirect('teachers');
                // return response()->json(['status' => true, 'message' => "User updated successfully", 'data' => $response]);
            } else {
                return response()->json(['status' => false, 'message' => "No such user exists"]);
            }
        } else {
            return response()->json(['status' => false, 'message' => "No such user exists"]);
        }

    }



    public function Levels()
    {
        $result = Level::select('*')->get();

        if ($result->isNotEmpty()) {
            return view('create_user', ['level' => $result]);
        } else {
            return response()->json(['status' => false, 'message' => "Failed to retrieve data"]);
        }
    }

    public function Getstudents($id)
    {
        $teacher = User::find($id);
    
        if (!$teacher) {
            return response()->json(['status' => false, 'message' => "No such user found"]);
        }
    
        $students = Student::where('instructor_id', $id)->get();
    // dd($students);
        if ($students->isEmpty()) {
            return response()->json(['status' => false, 'message' => "No students found for this teacher"]);
        }
    
        return view('teachers_view', ['response' => $students]);
    }
    
    //Approve Tasks
    public function ApproveTask(Request $request, $task_id){
 
                $user_id = Session::get('user');
                $is_approved = $request->is_approved;
                $role = User::select('role')->where(["id" => $user_id])->first();
                if($role->role == 1){
        
                    $result  = Task::where("task_id",$task_id)->update([
                        'is_admin_approved'  => $is_approved,
                    ]);
        
                    $data = [
                        'task_id' => $task_id,
                        'is_approved' => $is_approved
                    ];
                    if($result){
                        return response()->json(['status'=>true, 'message'=>"Task approved.", 'data' => $data ]);
                    } else {
                        return response()->json(['status' =>false, 'message' => "Faild to approve task", 'data'=>$data]);
                    }
                } else {
                    return respone()->json(['status'=> false, 'message' => "Only admin allowed to perform this action"]);
                }
            }

        public function DeactivateInstructor(Request $request, $instructor_id){

            $user = Session::get('user');
            $user_id = $user->id;
            $is_approved = $request->is_approved;
            $role = User::select('role')->where(["id" => $user_id])->first();
        
            if($role->role == 1){
                
                if(User::where('id', $instructor_id)->exists()){
                    $result = User::where('id', $instructor_id)->update([
                        'is_active' => 0
                    ]); 

                    if($result = true){
                        return redirect('teachers')->with('message', 'Instructor deactivated successfully');
                      //  return response()->json(['status'=>true, 'message' => "User deactivated successfully"]);
                    } else {
                        return redirect('teachers')->with('error', 'Failed to deactivate');
                       // return response()->json(['status'=>false, 'message'=>"Failed to deactivate"]);
                    }

                } else {
                    return redirect('teachers')->with('error', 'No such instructor exists');
                   // return response()->json(['status'=>false, 'message' => "No such instructor exists"]);
                }

            } else {
                return redirect('teachers')->with('error', 'Only admin have the permission to deactivate the instructor');
              //  return response()->json(['status'=>false, 'message' => "Only admin have the permission to deactivate the instructor"]);
            }

        }

        //Notifications
        public function getAllNotification(){
            
            $notifications = AdminNotification::leftjoin('tasks', 'tasks.task_id', '=','admin_notifications.task_id')
                                            ->leftjoin('users','users.id','=','admin_notifications.user_id')
                                            ->leftjoin('request_for_edits','request_for_edits.task_id','=','admin_notifications.task_id')
                                            ->select('admin_notifications.notification_text', 'tasks.task_id','tasks.task_name', 'users.first_name','users.last_name', 'admin_notifications.created_at')
                                            ->where('request_for_edits.is_admin_approved', 0)
                                            ->get();
            
            $today = Carbon::today()->format('Y-m-d');
            $count = AdminNotification::select('id')->where(['created_at' => $today, 'is_approved' => 0])->count();

            if($notifications){
             
                return response()->json(['status' => true, 'message' =>"Data retreived", 'data' => $notifications, 'count' => $count]);
            } else {
                
                return response()->json(['status' => false, 'message' =>"No data found"]);
            }
            
        }

    // Assign instructor to intern
    public function AssignInstructor(Request $request,$intern_id){
        $instructor_id = $request->instructor_id;

        if(Student::where('id', $intern_id)->exists()){

            $result = Student::where('id', $intern_id)->update(['instructor_id' => $instructor_id]);

            if($result == true){
                return response()->json(['status'=>true, 'message'=>"Updated instructor"],200);
            } else {
                return response()->json(['status'=>false, 'message'=>"Failed to update instructor"], 200);
            }
        }
    }

     // Assign level to intern
     public function AssignLevel(Request $request,$intern_id){
        $level_id = $request->level_id;
        
        if(Student::where('id', $intern_id)->exists()){

              if($level_id > 1){
                $result = StudentDetail::where('student_id', $intern_id)->update(['level_id' => $level_id, 'mode' => "Paid"]);

                if($result == true){
                    return response()->json(['status'=>true, 'message'=>"Updated Level"],200);
                } else {
                    return response()->json(['status'=>false, 'message'=>"Failed to update level"], 200);
                }
            } else {
                $result = StudentDetail::where('student_id', $intern_id)->update(['level_id' => $level_id]);

                if($result == true){
                    return response()->json(['status'=>true, 'message'=>"Updated Level"],200);
                } else {
                    return response()->json(['status'=>false, 'message'=>"Failed to update level"], 200);
                }
            }        } else {
            return response()->json(['status'=>false, 'message'=>"Student not found"], 200);
        }
    }

    //Redirecting to others page
    public function Others(Request $request){

        return view('others');
    }

    
      // student category
   public function AddStudentCategory(Request $request){

    $user = Session::get('user');
    $user_id = $user->id;
    
    $category_name = $request->module_name;
    $topic = $request->topic;
    $task_category = $request->task_category;
    $parent_id = $request->parent_id ? $request->parent_id : null;

    $result = StudentCategory::insert([
        'category_name' => $category_name,
        'topic_id' => $topic,
        'task_category_id' => $task_category,
        'created_by' => $user_id,
        'parent_id' => $parent_id,
        'is_active' => 1,
        'created_at' => date('Y-m-d')
    ]);

    if($result = true){
        return redirect()->route('listStudentCategory');
        return response()->json(['status'=>true, 'message'=>"Student category added", 'data' => $category_name], 200);
    } else {
        return response()->json(['status'=>false, 'message'=>"Failed to create category"], 422);
    }
}

//update student category
public function UpdateStudentCategory(Request $request, $category_id){

    $user = Session::get('user');
    $user_id = $user->id;

    if(StudentCategory::where('id', $category_id)->exists()){

        $categoryDetails = StudentCategory::select('*')->where('id', $category_id)->first();
        $new_category_name = $request->new_category_name ? $request->new_category_name : $categoryDetails->category_name;
        $topic = $request->topic ? $request->topic : $categoryDetails->topic_id;
        $task_category = $request->task_category ? $request->task_category : $categoryDetails->task_category_id;
        $topic = $request->topic ? $request->topic : $categoryDetails->topic_id;
        $parent = $request->parent_id ? $request->parent_id : $categoryDetails->parent_id; 

        $result = StudentCategory::where('id', $category_id)->update([
            'category_name' => $new_category_name,
            'topic_id' => $topic,
            'task_category_id' => $task_category,
            'parent_id' => $parent,
            'updated_by' => $user_id
        ]);
        if($result == true){
            return redirect()->route('listStudentCategory');
            return response()->json(['status'=>true, 'message'=>"Category updated", 'data'=>$new_category_name],200);
        } else {
            return response()->json(['status'=>false, 'message'=>"Failed to update category"], 422);
        }
    } else {
        return response()->json(['status'=>false, 'message'=>"Category not found"], 404);
    }
}


//Remove student category
public function DeactivateStudentCategory(Request $request, $category_id){

    if(StudentCategory::where('id', $category_id)->exists()){

        $owner = StudentCategory::select('created_by')->where('id', $category_id)->first();

        $user = Session::get('user');
        $user_id = $user->id;
        $role = User::select('role')->where('id', $user_id)->first();

        if($owner->created_by == $user_id){
            $result = StudentCategory::where('id', $category_id)->update([
                'is_active' => 0
            ]);

            if($result = true){
                return redirect()->route('listStudentCategory');
                return response()->json(['status'=>true,'message'=>"Deactivated student category"], 200);
            } else {
                return response()->json(['status'=>false, 'message'=>"failed to deactivate student category"], 422);
            }
        } elseif ($role->role == 1)  {
            $result = StudentCategory::where('id', $category_id)->update([
                'is_active' => 0
            ]);

            if($result = true){
                return redirect()->route('listStudentCategory');
                return response()->json(['status'=>true,'message'=>"Deactivated student category"], 200);
            } else {
                return response()->json(['status'=>false, 'message'=>"Failed to deactivate student category"], 422);
            }
        } else {
            return response()->json(['status'=>false, 'message'=>"Only authorized person allowed to dectivate"], 422);
        }
    } else {
        return response()->json(['status'=>false, 'message'=>"No such student category"], 404);
    }
}

//Show category
public function ShowStudentCategory(Request $request, $category_id){

    $result = StudentCategory::leftjoin('task_categories','task_categories.id','=','student_categories.task_category_id')
                            ->leftjoin('topics','topics.id','=','student_categories.topic_id')
                            ->select('student_categories.id', 'student_categories.category_name','topics.topic as topic_name','task_categories.category_name as task_category')
                            ->where(['student_categories.id' => $category_id, 'student_categories.is_active'=> 1])
                            ->get();

    $checkParent = StudentCategory::select('parent_id')->where('id', $category_id)->first();
    if($checkParent->parent_id != null){
        $parent = StudentCategory::select('id', 'category_name')->where('id', $checkParent->parent_id)->first();
        $result[0]['parent_id'] = $parent->id;
        $result[0]['parent'] = $parent->category_name;
    } else {
        $result[0]['parent_id'] = null;
        $result[0]['parent'] = null;
    }
    $topics = Topic::select('id','topic')->get();
    $task_category = TaskCategory::select('id','category_name as task')->where('is_active', 1)->get();
    $sub_modules = StudentCategory::select('id', 'category_name as module')->where('is_active', 1)->get();

    if($result != null){
        return view('update_category', ['category' => $result, 'topic' => $topics, 'task_category' => $task_category, 'sub_modules' => $sub_modules]);
        return response()->json(['status'=>true, 'message'=>"Data retreived",'data'=>$result], 200);
    } else {
        return response()->json(['status'=>false, 'message'=>"No data found"], 404);
    }
}
//List student categories
public function ListStudentCategories(Request $request){

    $result = StudentCategory::leftjoin('users','student_categories.created_by', '=', 'users.id')
                                ->leftjoin('task_categories', 'task_categories.id','=','student_categories.task_category_id')
                                ->leftjoin('topics','topics.id','=','student_categories.topic_id')
                                ->select('student_categories.id', 'student_categories.category_name', 'student_categories.created_by','student_categories.updated_by', 
                                'users.first_name','users.last_name', 'task_categories.category_name as task_category','topics.topic')
                                ->where('student_categories.is_active', 1)
                                ->get();

    if($result){
        return view('student_category_list', ['category' => $result]);
        return response()->json(['status'=>true, 'message'=>"Data retreived",'data'=>$result], 200);
    } else {
        return response()->json(['status'=>false, 'message'=>"No data found"], 404);
    }
}

//Task categories
    public function AddTaskCategory(Request $request){

        $user = Session::get('user');
        $user_id = $user->id;
        $result = TaskCategory::insert([
            'category_name' => $request->category_name,
            'is_active' => 1,
            'created_by' => $user_id,
            'created_at' => date('Y-m-d')
        ]);
        if($result = true){
            return redirect()->route('listTaskCategory');
            return response()->json(['status'=>true, 'message'=>"Category added successfully"], 200);
        } else {
            return response()->json(['status'=>false, 'message'=>"Failed to add category"], 404);
        }
    }
 

    //Update task category
    public function UpdateTaskCategory(Request $request, $category_id){

        $result = TaskCategory::where('id', $category_id)->update([
            'category_name' => $request->new_category_name,
        ]);

        if($result = true){
            return redirect()->route('listTaskCategory');
            return response()->json(['status'=>true, 'message'=>"Category updated successfully"], 200);
        } else {
            return response()->json(['status'=>false, 'message'=>"Failed to update category"], 404);
        }
    }

    //Remove task category
    public function RemoveTaskCategory($category_id){

        $result = TaskCategory::where('id', $category_id)->update([
            'is_active' => 0,
        ]);

        if($result = true){
            return redirect()->route('listTaskCategory');
            return response()->json(['status'=>true, 'message'=>"Category removed successfully"], 200);
        } else {
            return response()->json(['status'=>false, 'message'=>"Failed to remove category"], 404);
        }
    }

    //List task categories
    public function ListTaskCategories(Request $request){

        $result = TaskCategory::leftjoin('users','users.id','=','task_categories.created_by')
                                ->select('task_categories.id', 'task_categories.category_name', 'task_categories.created_at','users.first_name','users.last_name')
                                ->where(['task_categories.is_active' => 1])
                                ->get();

        if($result != null){
            return view('task_category_list', ['data' => $result]);
            return response()->json(['status'=>true, 'message'=>"Task categories listed successfully", 'data'=>$result],200);
        } else {
            return response()->json(['status'=>false, 'message'=>"Failed to list task categories"],400);
        }
    }

    //Show task category
    public function ShowTaskCategory($category_id){

        $result = TaskCategory::select('id','category_name')->where('id', $category_id)->get();

        if($result != null){
            return view('update_task_category', ['data' => $result]);
            return response()->json(['status'=>true, 'message'=>"Data retreived", 'data' => $result], 200);
        } else {
            return response()->json(['status'=>false, 'message'=>"Failed to retreive data"], 400);
        }
    }


    //Get employers list
    public function GetEmployersList(Request $request){

        $result = Employee::leftjoin('employee_companies','employees.id','=','employee_companies.employee_id')
			    ->leftjoin('request_for_intern_contacts','employees.id','=','request_for_intern_contacts.employer_id')
                            ->select('employees.id','employees.first_name', 'employees.last_name', 'employees.country','employees.created_at',
                                        'employee_companies.designation', 'employee_companies.company_name')
                            ->get();

        if($result != null){
            return view('employer_list', ['data' => $result]);
            return response()->json(['status'=>true, 'message'=>"Employers listed successfully", 'data'=>$result], 200);
        } else {
            return response()->json(['status'=>false, 'message'=>"Failed to list employers"], 400);
        }
    }

    //Get employers details by id
    public function GetEmployerById($employer_id){

        if(Employee::where('id', $employer_id)->exists()){

            $result = Employee::leftjoin('employee_companies','employees.id','=','employee_companies.employee_id')
                                ->select('employees.id','employees.first_name','employees.last_name','employees.address1','employees.address2','employees.district','employees.state',
                                        'employees.country','employees.pincode','employees.email_id','employees.phone','employees.age','employees.gender','employee_companies.company_name',
                                        'employee_companies.designation','employee_companies.company_address1','employee_companies.company_address2','employee_companies.company_district',
                                        'employee_companies.company_state','employee_companies.company_country','employees.profile_pic','employees.profile_path',
                                        DB::raw("DATE_FORMAT(employees.created_at, '%Y-%m-%d') as created_at"))
                                ->where('employees.id', $employer_id)
                                ->get();
      
            if($result[0]->profile_pic != null){
                $employer_profile = $this->downloadProfilePhoto($result[0]['id']);
                                                                           
                $employerProfileUrl = url('/api/downloadProfilePhoto/' . $result[0]['id']);
                                                                            
                $employerProfilePic = [
                                        'id' => $result[0]['id'],
                                        'download_link' => $employer_profile,
                                    ];
                                                                            
                $result[0]['profilePic'] = $employer_profile;
            } else {
                $result[0]['profilePic'] = null;
            } 

            if($result != null){
                return view('employer_view', ['data' => $result]);
                return response()->json(['status'=>true, 'message'=>"Employer details retreived successfully", 'data'=> $result], 200);
            } else {
                return response()->json(['status'=>false, 'message'=>"Failed to retreive employer details"], 422);
            }
        } else {
            return response()->json(['status'=>false, 'message'=>"No such employer"], 404);
        }
    }

    //Download Profile photo
    public function downloadProfilePhoto($fileId)
    {
        $fileDetails = Employee::find($fileId);
        
        if (!$fileDetails) {
            
            $content = "File not found";
            return $content;
        }
        $filePath = public_path("/{$fileDetails->profile_path}");
       
     
            $imageUrl = url('/uploads/'.$fileDetails->profile_path);
        
             return $imageUrl;
    
    }

    public function GetTopics(){

        $result = Topic::select('id','topic')->get();
        $task_category = TaskCategory::select('id','category_name')->where('is_active', 1)->get();
        $sub_modules = StudentCategory::select('id', 'category_name')->where('is_active', 1)->get();

        if($result != null){
            return view('add_new_category', ['topic' => $result, 'task_category'=> $task_category, 'submodules' => $sub_modules]);
            return response()->json(['status'=>true, 'message'=>"Data retreived", 'data'=>$result], 200);
        } else {
            return response()->json(['status'=>false, 'message'=>"Failed to retreive data"], 422);
        }
    }

     //View student category by id
     public function GetModulesById($module_id)
     {
         if (StudentCategory::where('id', $module_id)->exists()) {
       
             $result = StudentCategory::leftJoin('topics', 'topics.id', '=', 'student_categories.topic_id')
                             ->leftjoin('users', 'users.id', '=', 'student_categories.created_by')
                             ->leftjoin('task_categories','task_categories.id','=','student_categories.task_category_id')
                             ->select('student_categories.id','student_categories.category_name', 'topics.topic', 'users.first_name', 'users.last_name','task_categories.category_name as task_category')
                             ->where(['student_categories.id' => $module_id, 'student_categories.is_active' => 1])
                             ->get();
    
             $parents = [];
   
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
   
             $result[0]['parent'] = $parents;
 
             if (!empty($result)) {
                 return view('student_category_view', ['data' => $result]);
                 return response()->json(['status' => true, 'message' => "Data retrieved", 'data' => $result], 200);
             } else {
                 return view('student_category_view', ['data' => $result]);
                 return response()->json(['status' => false, 'message' => "Failed to retrieve data"], 400);
             }
         } else {
        
             return response()->json(['status' => false, 'message' => "No such module exists"], 404);
         }
     }

	
  //RequestForInternContact list
     public function RequestForInternContactList(Request $request, $employer_id){

        $result = RequestForInternContact::leftjoin('employees','request_for_intern_contacts.employer_id','=','employees.id')
                                        ->leftjoin('students','request_for_intern_contacts.intern_id','=','students.id')
                                        ->select('students.id as student_id','students.first_name as student_first_name', 'students.last_name as student_last_name',
                                        'employees.first_name as employer_first_name', 'employees.last_name as employer_last_name', 'request_for_intern_contacts.is_admin_approved',
                                        'request_for_intern_contacts.created_at','employees.id as employer_id')
                                        ->where('request_for_intern_contacts.employer_id', $employer_id)
					->distinct()
                                        ->get();

        if($result != null){
            return view('request_for_intern_contact',['data' => $result]);
        } else {
            return view('request_for_intern_contact',['data' => $result]);
        }
     }

	
	 // Approve or reject request for intern contact from employer

	public function ApproveRequestContact(Request $request){

        $intern_id = $request->intern_id;
        $employer_id = $request->employer_id;
        if(Student::where('id', $intern_id)->exists()){
     
            $result = RequestForInternContact::where(['intern_id' => $intern_id, 'employer_id' => $employer_id])->update([
                'is_admin_approved' => 1
            ]);

            if($result = true){
                return response()->json(['status'=>true, 'message'=>"Request approved"], 200); 
            } else {
                return response()->json(['status'=>false, 'message'=>"Failed to approve request"], 422);
            }
        } else {
          return response()->json(['status'=>false, 'message'=>"No such intern"], 404);
       }
    }

        public function RejectRequestContact(Request $request){
	
		$intern_id = $request->intern_id;
        $employer_id = $request->employer_id;

    
            if(Student::where('id', $intern_id)->exists()){
    
                $result = RequestForInternContact::where(['intern_id' => $intern_id, 'employer_id' => $employer_id])->update([
                    'is_admin_approved' => 0
                ]);
    
                if($result = true){
                    return response()->json(['status'=>true, 'message'=>"Request rejected"], 200); 
                } else {
                    return response()->json(['status'=>false, 'message'=>"Failed to approve request"], 422);
                }
            } else {
          return response()->json(['status'=>false, 'message'=>"No such intern"], 404);
       }

    }

	

}
