<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\StudentProfile;
use App\Models\StudentTask;
use App\Models\RequestForInternContact;
use App\Models\EmployeeCompany;
use App\Models\EmployeeTask;
use App\Models\EmployeeTaskAttachment;
use App\Models\Student;
use App\Models\StudentDetail;
use App\Models\SelectIntern;
use App\Models\AssignEmployerTask;
use App\Models\AdminNotification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;
use Session;
use DB;

class EmployeeController extends Controller
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

    public function EmployeeRegistration(Request $request){

        $input = $request->only('first_name', 'last_name', 'email', 'phone', 'password', 'company_name', 'designation');

        $validator = Validator::make($input, [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required|min:10|max:12',
            'password' => 'required|min:6',
            'company_name' => 'required',
            'designation' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error', 422);
        }
        $password = Hash::make($request->password);
        // $password = bcrypt($request->password); // use bcrypt to hash the passwords

	//check whether the email is valid
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return $this->sendError('Email is not valid', 'Email is not valid',422);
        } else {
            list($user, $domain) = explode('@', $request->email);
            if (!checkdnsrr($domain, 'MX')) {
                return $this->sendError('Invalid email domain', 'Invalid email domain', 422);
            }
        }

        $emailCheck = Employee::select('*')->where('email_id', $request->email)->first();

        if ($emailCheck == null) {
            $user = Employee::insertGetId([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email_id' => $request->email,
                'phone' => $request->phone,
                'password' => $password,
                'is_active' => 1,
                'created_at' => date('Y-m-d'),
                'is_completed' => 0,
                'state' => $request->state,
                'country' => $request->country
            ]); // eloquent creation of data
                 
            $employee = EmployeeCompany::insert([
                'employee_id' => $user,
                'company_name' => $request->company_name,
                'designation' => $request->designation,
                'created_at' => date('Y-m-d')
            ]);

            return response()->json(['status' => true, 'message' => "Employee registered successfully"]);
        } else {
            return response()->json(['status' => false, 'message' => "User already exists"]);
        }

    }

    //Employee login
    public function login(Request $request)
    {
      $input = $request->only('email', 'password');

      $validator = Validator::make($input, [
    	'email' => 'required',
    	'password' => 'required',
		]);

	if ($validator->fails()) {
    	return $this->sendError($validator->errors(), 'Validation Error', 422);
	}

	// Generate a new remember token
	$token = md5(uniqid() . rand(1000000, 9999999));
	
	// Fetch the user
	$result = Employee::where('email_id', $request->email)->first();

	if ($result) {
        $checkActive = Employee::select('is_active')->where('id', $result->id)->first();
        if($checkActive->is_active == 1){
              // Fetch existing remember tokens
    	$rememberTokens = json_decode($result->remember_token, true);

        // Limit the remember tokens to 4
            $rememberTokens[] = $token;
            if (count($rememberTokens) > 4) {
            // Remove the oldest token
                array_shift($rememberTokens);
            }
    
        // Update user's remember tokens
            Employee::where('email_id', $request->email)->update(['remember_token' => json_encode($rememberTokens)]);
    
        // Check password
            $hashedPassword = $result->password;
            if (Hash::check($request->password, $hashedPassword)) {
            
    
            $success = [
                'token' => $token,
                'email_id' => $request->email,
                'name' => $result->first_name,
                'id' => $result->id,
                'is_completed' => $result->is_completed,
               
            ];
                return $this->sendResponse($success, 'successful login', 200);
            } else {
                return response()->json(['status' => false, 'message' => "Invalid credentials"]);
            }
        } else {
            return response()->json(['status'=>false, 'message' => "This account is deactivated. Please contact admin"], 200);
        }
      
	} else {
    		return response()->json(['status' => false, 'message' => "No such user"]);
	}
    }

    //Update profile
    public function updateProfile(Request $request, $employee_id){

        if(Employee::where('id', $employee_id)->exists()){
            $user_access_token  = $request->token;
            $TokenCheck = Employee::where('id', $employee_id)->first();
            $DB_token = json_decode($TokenCheck->remember_token, true);
        
            if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {
    

                $employeeDetails = Employee::select('*')->where('id', $employee_id)->first();

                $first_name = $request->first_name ? $request->first_name : $employeeDetails->first_name ;
                $last_name = $request->last_name ? $request->last_name : $employeeDetails->last_name ;
                $date_of_birth = $request->date_of_birth ? $request->date_of_birth : $employeeDetails->date_of_birth;
                $age = $request->age  ? $request->age : $employeeDetails->age;
                $gender = $request->gender ?$request->gender : $employeeDetails->gender;
                $address1 = $request->address1 ? $request->address1 : $employeeDetails->address1;
                $address2 = $request->address2 ? $request->address2 : $employeeDetails->address2;
                $district = $request->district ? $request->district : $employeeDetails->district;
                $state = $request->state ? $request->state : $employeeDetails->state;
                $pincode = $request->pincode ? $request->pincode : $employeeDetails->pincode;
                $phone = $request->phone ? $request->phone : $employeeDetails->phone;
                $country = $request->country ? $request->country : $employeeDetails->country;

                $result = Employee::where('id', $employee_id)->update([
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'date_of_birth' => $date_of_birth,
                    'age' => $age,
                    'gender' => $gender,
                    'address1' => $address1,
                    'address2' => $address2,
                    'district' => $district,
                    'state' => $state,
                    'country' => $country,
                    'pincode' => $pincode,
                    'phone' => $phone
                ]);

                if($result == true){
                    return response()->json(['status' => true, 'message' => "Updated successfully"], 200);
                } else {
                    return response()->json(['status' => false, 'message' => "failed to update"], 200);
                }
            } else {
                return response()->json(['status' => false, 'message' => "Invalid token"], 401);
            }
        } else {
            return response()->json(['status' =>false, 'message' => "Employee not found"], 400);
        }

    }

    // Employee professional details
    public function EmployeeProfessionalDetails(Request $request, $employee_id){
        if(Employee::where('id', $employee_id)->exists()){
            $user_access_token  = $request->token;
            $TokenCheck = Employee::where('id', $employee_id)->first();
            $DB_token = json_decode($TokenCheck->remember_token, true);
        
            if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {
                
                $company_name = $request->company_name;
                $company_address1 = $request->company_address1;
                $company_address2 = $request->company_address2;
                $company_district = $request->company_district;
                $company_state = $request->company_state;
                $company_country = $request->company_country;
                $company_pincode = $request->company_pincode;
                $designation = $request->designation;

                $result = EmployeeCompany::insert([
                    'employee_id' => $employee_id,
                    'company_name' => $company_name,
                    'company_address1' => $company_address1,
                    'company_address2' => $company_address2,
                    'company_district' => $company_district,
                    'company_state' => $company_state,
                    'company_country' => $company_country,
                    'company_pincode' => $company_pincode,
                    'designation' => $designation,
                    'created_at' => date('Y-m-d')
                ]);

                if($result == true){

                    $profile_completion = Employee::where('id', $employee_id)->update([
                        'is_completed' => 1
                    ]);

                    return response()->json(['status' => true, 'message' => "Professional details added successfully"], 200);
                } else {
                    return response()->json(['status' => false, 'message' =>"Failed to add details"], 200);
                }
            } else {
                return response()->json(['status' => false, 'message' => "Invalid token"], 401);
            }
        } else {
            return response()->json(['status' => false, 'message' => "Employee not found"], 400);
        }

    }

    //Deactivate employee
    public function deactivateEmployee(Request $request, $employee_id){
        if(Employee::where('id', $employee_id)->exists()){
            $user_access_token  = $request->token;
            $TokenCheck = Employee::where('id', $employee_id)->first();
            $DB_token = json_decode($TokenCheck->remember_token, true);
        
            if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {

                $result = Employee::where('id', $employee_id)->update([
                    'is_active' => 0
                ]);

                if($result == true){
                    return response()->json(['status'=>true, 'message'=>"Employee Deactivated"], 200);
                } else {
                    return response()->json(['status'=>false, 'message' =>"Failed to deactivate employee"], 200);
                }
            } else {
                return response()->json(['status'=>false, 'message' =>"Invalid token"], 401);
            }
        } else {
            return response()->json(['status'=>false, 'message'=>"Employee not found"], 400);
        }  

    }

    //Get employees list for admin panel
    public function getEmployees(){

        $result = Employee::leftjoin('employee_company','employee_company.employee_id','=','employees.id')
                            ->select('employees.id', 'employees.first_name', 'employees.last_name','employees.created_at','employee_company.designation','employee_company.company_name','employee_company.country')
                            ->where('employees.is_active', 1)
                            ->paginate(10);

        if($result == true){
            return response()->json(['status'=>true, 'message'=>"Data retreived", 'data'=>$result], 200);
        }else {
            return response()->json(['status'=>false, 'message'=>"Failed to retreive data", 'data' => $result], 200);
        }
    }

    //Get employee details by id
    public function getEmployeesById($employer_id){

         $result = Employee::leftjoin('employee_companies','employees.id','=','employee_companies.employee_id')
                        ->select('employees.first_name','employees.last_name','employees.address1','employees.address2','employees.district','employees.state',
                                'employees.country','employees.pincode','employees.email_id','employees.phone','employees.age','employees.gender','employee_companies.company_name',
                                'employee_companies.designation','employee_companies.company_address1','employee_companies.company_address2','employee_companies.company_district',
                                'employee_companies.company_state','employee_companies.company_country','employees.profile_pic','employees.profile_path')
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

        if($result){
            return response()->json(['status'=>true, 'message'=>"Data retreived", 'data'=>$result], 200);
        }else {
            return response()->json(['status'=>false, 'message'=>"Failed to retreive data", 'data' => $result], 200);
        }
    }

    //Get interns list in rankwise order
    public function GetInternsList(Request $request, $employee_id){
        if(Employee::where('id', $employee_id)->exists()){
            $user_access_token  = $request->token;
            $TokenCheck = Employee::where('id', $employee_id)->first();
            $DB_token = json_decode($TokenCheck->remember_token, true);
        
            if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {
                $result = StudentProfile::leftJoin('students', 'students.id', '=', 'student_profiles.student_id')
                                ->leftJoin('student_details', 'student_profiles.student_id', '=', 'student_details.student_id')
                                ->leftJoin('levels', 'student_details.level_id', '=', 'levels.id')
                                ->leftJoin('student_tasks', 'students.id', '=', 'student_tasks.student_id')
                                ->select('students.id','students.first_name', 'students.last_name', 'students.created_at','levels.level_name', DB::raw('COUNT(student_tasks.task_id) as task_count'))
                                ->where(['students.is_active'=> '1', 'student_tasks.is_completed' => 1])
                                ->groupBy('students.id', 'levels.level_name') // Group by both student ID and level name
                                ->orderBy('task_count', 'desc') // Order by student creation date
                                ->paginate(10);
                            //    ->get();
                                                
                if($result == true){
                    return response()->json(['status' => true, 'message' => "Data retreived", 'data' => $result], 200);
                } else {
                    return response()->json(['status' => false, 'message' =>"Failed to retreived", 'data' => $result], 200);
                }
            } else {
                return response()->json(['status'=>false, 'message'=>"Invalid token"], 401);
            }
        } else {
            return response()->json(['status' => false, 'message' =>"Employee not found"], 400);
        }
    }


    //Interns view in cv
    public function getInternsResume(Request $request, $employee_id){

     $intern_id = $request->intern_id;
     if(Employee::where('id', $employee_id)->exists()){
    	$user_access_token  = $request->token;
    	$TokenCheck = Employee::where('id', $employee_id)->first();
    	$DB_token = json_decode($TokenCheck->remember_token, true);

    	if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {
	  
          $request_for_contact = RequestForInternContact::select('*')->where(['intern_id' => $intern_id, 'employer_id' => $employee_id])->count();

          if($request_for_contact > 0){
                   
            $request_approval = RequestForInternContact::select('is_admin_approved')->where(['intern_id' => $intern_id, 'employer_id' => $employee_id])->first();

	    $approval = $request_approval->is_admin_approved;

            if($approval == 0 ){
        	$result = Student::leftjoin('student_profiles', 'students.id', '=', 'student_profiles.student_id')
                    ->leftjoin('student_details', 'student_profiles.student_id', '=', 'student_details.student_id')
                
                    ->select(
                        'students.id as id',
                        'students.first_name',
                        'students.last_name',
                        'students.address1',
                        'students.address2',
                        'students.district',
                        'students.city',
                        'students.state',
                        'students.country',
                        'students.pincode',
                        'students.age',
                        'students.gender',
                        'students.date_of_birth',
                        'student_profiles.highest_qualification',
                        'student_profiles.board',
                        'student_profiles.institute',
                        'student_profiles.year_of_passing',
                        'student_profiles.total_marks',
                        'student_details.mode',
                        'student_details.level_status',
                        //'courses.course_name',
                       // 'courses.course_desc',
                        'students.is_completed',
                        'student_profiles.educational_details',
                        'student_profiles.experience',
                        'student_profiles.additional_qualification',
                        'student_profiles.expected_salary',
			            'student_profiles.skills',
                        'students.profile_pic'
                    )
                    ->where('students.id', $intern_id)
                    ->first();

             
                $task_performance = StudentDetail::leftjoin('levels','student_details.level_id','=','levels.id')
                    ->leftjoin('difficulty_levels','student_details.difficulty_level','=','difficulty_levels.id')
                    ->select('student_details.id','student_details.level_id','student_details.difficulty_level','levels.level_name as level','difficulty_levels.level_name as difficulty','student_details.level_status')
                    ->where('student_details.student_id', $intern_id)
                    ->get();

                $no_of_tasks_completed = StudentTask::select('*')->where(['student_id'=> $intern_id, 'is_completed' => 1, 'level_id' => $task_performance[0]['level_id'], 'difficulty_id'=>$task_performance[0]['difficulty_level']])->count();

                $no_of_tasks_pending = StudentTask::select('*')->where(['student_id'=> $intern_id, 'is_completed' => 0,'level_id' => $task_performance[0]['level_id'], 'difficulty_id'=>$task_performance[0]['difficulty_level']])->count(); 
		
                $result['request_approval'] = 0;
		        $result['request_for_contact'] = 1;
                $result['level'] = $task_performance[0]->level;
                $result['no_of_tasks_completed'] = $no_of_tasks_completed;
                $result['no_of_tasks_pending'] = $no_of_tasks_pending;

            if($result) {
            	if($result->profile_pic != null){
                	$student_profile = $this->downloadImage($result->id); // Assuming $this refers to the current controller

                	$studentProfileUrl = url('/api/downloadImage/' . $result->id);
                	$result->imageLink = $student_profile;
            	} else {
                	$result->imageLink = null;
            	}

            	return response()->json(['status' => true, 'message' => "Data retrieved", 'data' => $result], 200);
           } else {
            	return response()->json(['status' => false, 'message' => "Failed to retrieve data", 'data' => null], 200);
           }
         } else {
                $result = Student::leftjoin('student_profiles', 'students.id', '=', 'student_profiles.student_id')
                            ->leftjoin('student_details', 'student_profiles.student_id', '=', 'student_details.student_id')
                        
                            ->select(
                                'students.id as id',
                                'students.first_name',
                                'students.last_name',
                                'students.address1',
                                'students.address2',
                                'students.district',
                                'students.city',
                                'students.state',
                                'students.country',
                                'students.pincode',
                                'students.age',
                                'students.gender',
                                'students.date_of_birth',
                                'student_profiles.highest_qualification',
                                'student_profiles.board',
                                'student_profiles.institute',
                                'student_profiles.year_of_passing',
                                'student_profiles.total_marks',
                                'student_details.mode',
                                'student_details.level_status',
                                'students.is_completed',
                                'student_profiles.educational_details',
                                'student_profiles.experience',
                                'student_profiles.additional_qualification',
                                'student_profiles.expected_salary',
                                'student_profiles.skills',
                                'students.profile_pic',
                                'students.phone',
                                'students.email_id',
                                'students.address1',
                                'students.address2',
                                'students.district',
                                'students.city',
                                'students.state',
                                'students.country',
                                'students.pincode',
                            )
                            ->where('students.id', $intern_id)
                            ->first();

                    
                        $task_performance = StudentDetail::leftjoin('levels','student_details.level_id','=','levels.id')
                            ->leftjoin('difficulty_levels','student_details.difficulty_level','=','difficulty_levels.id')
                            ->select('student_details.id','student_details.level_id','student_details.difficulty_level','levels.level_name as level','difficulty_levels.level_name as difficulty','student_details.level_status')
                            ->where('student_details.student_id', $intern_id)
                            ->get();

                        $no_of_tasks_completed = StudentTask::select('*')->where(['student_id'=> $intern_id, 'is_completed' => 1, 'level_id' => $task_performance[0]['level_id'], 'difficulty_id'=>$task_performance[0]['difficulty_level']])->count();

                        $no_of_tasks_pending = StudentTask::select('*')->where(['student_id'=> $intern_id, 'is_completed' => 0,'level_id' => $task_performance[0]['level_id'], 'difficulty_id'=>$task_performance[0]['difficulty_level']])->count(); 

                        $result['request_approval'] = 1;
                        $result['request_for_contact'] = 1;
                        $result['level'] = $task_performance[0]->level;
                        $result['no_of_tasks_completed'] = $no_of_tasks_completed;
                        $result['no_of_tasks_pending'] = $no_of_tasks_pending;

                    if($result) {
                        if($result->profile_pic != null){
                            $student_profile = $this->downloadImage($result->id); // Assuming $this refers to the current controller

                            $studentProfileUrl = url('/api/downloadImage/' . $result->id);
                            $result->imageLink = $student_profile;
                        } else {
                            $result->imageLink = null;
                        }

                        return response()->json(['status' => true, 'message' => "Data retrieved", 'data' => $result], 200);
                } else {
                        return response()->json(['status' => false, 'message' => "Failed to retrieve data", 'data' => null], 200);
                }
            }
          } else {
            $result = Student::leftjoin('student_profiles', 'students.id', '=', 'student_profiles.student_id')
                            ->leftjoin('student_details', 'student_profiles.student_id', '=', 'student_details.student_id')
                        // ->leftjoin('courses', 'student_details.course_id', '=', 'courses.id')
                            ->select(
                                'students.id as id',
                                'students.first_name',
                                'students.last_name',
                                'students.address1',
                                'students.address2',
                                'students.district',
                                'students.city',
                                'students.state',
                                'students.country',
                                'students.pincode',
                                'students.age',
                                'students.gender',
                                'students.date_of_birth',
                                'student_profiles.highest_qualification',
                                'student_profiles.board',
                                'student_profiles.institute',
                                'student_profiles.year_of_passing',
                                'student_profiles.total_marks',
                                'student_details.mode',
                                'student_details.level_status',
                                //'courses.course_name',
                            // 'courses.course_desc',
                                'students.is_completed',
                                'student_profiles.educational_details',
                                'student_profiles.experience',
                                'student_profiles.additional_qualification',
                                'student_profiles.expected_salary',
                                'student_profiles.skills',
                                'students.profile_pic'
                            )
                            ->where('students.id', $intern_id)
                            ->first();

                    
                        $task_performance = StudentDetail::leftjoin('levels','student_details.level_id','=','levels.id')
                            ->leftjoin('difficulty_levels','student_details.difficulty_level','=','difficulty_levels.id')
                            ->select('student_details.id','student_details.level_id','student_details.difficulty_level','levels.level_name as level','difficulty_levels.level_name as difficulty','student_details.level_status')
                            ->where('student_details.student_id', $intern_id)
                            ->get();

                        $no_of_tasks_completed = StudentTask::select('*')->where(['student_id'=> $intern_id, 'is_completed' => 1, 'level_id' => $task_performance[0]['level_id'], 'difficulty_id'=>$task_performance[0]['difficulty_level']])->count();

                        $no_of_tasks_pending = StudentTask::select('*')->where(['student_id'=> $intern_id, 'is_completed' => 0,'level_id' => $task_performance[0]['level_id'], 'difficulty_id'=>$task_performance[0]['difficulty_level']])->count(); 

                        $result['request_approval'] = 0;
                        $result['request_for_contact'] = 0;
                        $result['level'] = $task_performance[0]->level;
                        $result['no_of_tasks_completed'] = $no_of_tasks_completed;
                        $result['no_of_tasks_pending'] = $no_of_tasks_pending;

                    if($result) {
                        if($result->profile_pic != null){
                            $student_profile = $this->downloadImage($result->id); // Assuming $this refers to the current controller

                            $studentProfileUrl = url('/api/downloadImage/' . $result->id);
                            $result->imageLink = $student_profile;
                        } else {
                            $result->imageLink = null;
                        }

                        return response()->json(['status' => true, 'message' => "Data retrieved", 'data' => $result], 200);
                } else {
                        return response()->json(['status' => false, 'message' => "Failed to retrieve data", 'data' => null], 200);
                }
          }

       } else {
          return response()->json(['status' => false, 'message' => "Invalid token"], 401);
       }
     } else {
       return response()->json(['status' => false, 'message' => "No such user"], 400);
     }
    }

    //Download profile image
    public function downloadImage($fileId)
    {
        $fileDetails = Student::find($fileId);
    
        if (!$fileDetails) {
        
        $content = "File not found";
        return $content;
    	}
    	$filePath = public_path("/{$fileDetails->profile_path}");
 
   
        $imageUrl = url('/storage/app/public/'.$fileDetails->profile_path);
         
         return $imageUrl;
    }

    // Request for intern contact information
    public function requestInternContact(Request $request, $employee_id){

        $intern_id = $request->intern_id;
        if(Employee::where('id', $employee_id)->exists()){
            $user_access_token  = $request->token;
            $TokenCheck = Employee::where('id', $employee_id)->first();
            $DB_token = json_decode($TokenCheck->remember_token, true);
        
            if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {

		$check = RequestForInternContact::select('*')->where(['employer_id'=> $employee_id, 'intern_id'=>$intern_id])->first();

               if($check == null){
                $result = RequestForInternContact::insertGetId([
                    'employer_id' => $employee_id,
                    'intern_id' => $intern_id,
                    'is_admin_approved' => 0,
                    'created_at'  => date('Y-m-d') 
                ]);

                $admin_notification = AdminNotification::insertGetId([
                    'user_id' => $employee_id,
                    'notification_type' => 2,
                    'notification_text' => "Request for Intern contact information",
                    'request_id' =>  $result,
                    'is_approved' => 0,
                    'created_at' => date('Y-m-d')
                ]);

	       $data = [
                    'message' => 'Request sent successfully',
                    'status' => 200,
                    'request_id' => $result,    
                    'is_approved' => 0
                ];

                if($result == true){
                    return response()->json(['status'=>true, 'message' => "Request sent", 'data' => $data],200);
                }
             } else {
                   return response()->json(['status'=>false, 'message'=>"Request already sent"]);
          }
            } else {
                return response()->json(['status'=>false, 'message'=>"Invalid token"], 401);
            }
        } else {
            return response()->json(['status'=>false, 'message'=>"Employee not found"], 400);
        }

    }

    //Approve request for contact information by employer
    public function ApproveEmployerRequest($id){

        $result = AdminNotification::select('request_id')->where('id', $id)->first();

        if(Employee::where('id', $employee_id)->exists()){
            $user_access_token  = $request->token;
            $TokenCheck = Employee::where('id', $employee_id)->first();
            $DB_token = json_decode($TokenCheck->remember_token, true);
        
            if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {

                $notification = AdminNotification::where('id', $id)->update(['is_approved' => 1]);

                if($notification == true){
                    $approve = RequestForInternContact::where('id', $result->request_id)->update([
                        'is_admin_approved' => 1
                    ]);

                    if($approve == true){
                        return response()->json(['status'=>true, 'message'=>"Request approved", 'data'=>$approve], 200);
                    } else {
                        return response()->json(['status' =>false, 'message'=>"Failed to approve request"], 200);
                    }
                } else {
                    return response()->json(['status'=>false, 'message' =>"Failed to update notification table"], 200);
                }
            } else {
                return response()->json(['status'=>false, 'message'=>"Invalid token"], 401);
            }
        } else {
            return response()->json(['status'=>false, 'message'=>"No such user found"], 404);
        }
            
    }

    //View contact information
    public function ViewContactInformation(Request $request, $employee_id){

        if(Employee::where('id', $employee_id)->exists()){
            $user_access_token  = $request->token;
            $TokenCheck = Employee::where('id', $employee_id)->first();
            $DB_token = json_decode($TokenCheck->remember_token, true);
        
            if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {
                $intern_id = $request->intern_id;

                $information = Student::select('email', 'phone')->where('id', $employee_id)->get();

                if($information == true){
                    return response()->json(['status'=>true, 'message'=>"Data retreived", 'data'=> $information], 200);
                } else {
                    return response()->json(['status'=>false, 'message'=>"Failed to retreive data"], 200);
                }
            } else {
                return response()->json(['status'=>false, 'message'=>"Invalid token"], 401);
            }
        } else { 
            return response()->json(['status'=>false, 'message'=>"No such employee exists"], 400);
        }
    }

    public function CreateTask(Request $request, $employee_id)
    {

        if(Employee::where('id', $employee_id)->exists()){
            $user_access_token  = $request->token;
            $TokenCheck = Employee::where('id', $employee_id)->first();
            $DB_token = json_decode($TokenCheck->remember_token, true);
        
            if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {
            $taskDesc = "Task";

            $task_name = $request->task_name  ?? null ;
            $task_desc = $request->task_desc ??  $taskDesc;
            $is_active = 1;
            $NoOfQuestns = $request->NoOfQuestns ?? null;
            $NofQstnsAns = $request->NofQstnsAns ?? null;
            $time = $request->time;
            $created_by = $employee_id;
          //  $task_type = $request->task_type;

                $result = EmployeeTask::insertGetId([
                    'task_name' => $task_name,
                    'task_desc' => $task_desc,
                    'created_by' => $employee_id,
                    'is_active' => $is_active,
                    'NoOfQuestns' => 1,
                    'NoOfQstnsAns' => 1,
                    'created_at' => date('Y-m-d'),
                    'time' => $time,
                    'is_admin_approved' => 1,
                    'created_by' => $created_by,
                    // 'task_type' => $task_type
        
                ]);
                if ($result == true) {  
                    $task_id = $result;

                    if ($request->hasFile('file')) {
                        $files = $request->file('file');
                        foreach ($files as $file) {
                            $filename = $file->getClientOriginalName();
                            $path = $file->storeAs('employee_uploads', $filename, 'public'); // Adjust the storage path as needed

                        $fileModel = EmployeeTaskAttachment::insert([
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

                       // return redirect('select_task_type/'. $task_id.'/'. $NoOfQuestns);
                        // return redirect('addQuestion/' . $task_id . '/' . $NoOfQuestns);
                        return response()->json(['status' => true, 'message' => "Task added successfully", 'task_id' => $task_id]);
                    } else {
                     //   return redirect('taskDetails');
                        return response()->json(['status' => true, 'message' => "Task added successfully", 'task_id' => $task_id]);
                    }
            
                } else {
                    return response()->json(['status' => false, ' message' => "Failed to add task"]);
                }
            } else {
                return response()->json(['status' => false, 'message' => "Unauthorixed token"], 401);
            }
        } else {
            return response()->json(['status'=>false, 'message'=>"No such user"], 400);
        }
    }


    //Logout
    public function Logout(Request $request, $employee_id){

        if(Employee::where('id', $employee_id)->exists()){

            $result = Employee::where('id', $employee_id)->update([
                'remember_token' => null
            ]);

            if($result = true){
                return response()->json(['status'=>true, 'message'=>"Logged out successfully"], 200);
            } else {
                return response()->json(['status'=>false, 'message'=>"Failed to log out"], 422);
            }
        } else {
            return response()->json(['status' => false, 'message' => "Employee not found"], 400);
        }
    }

    //Get interns details by id
    public function InternsById(Request $request, $employee_id){

    $intern_id = $request->intern_id;
    if(Student::where('id', $intern_id)->exists()){
        if(Employee::where('id', $employee_id)->exists()){
            $user_access_token  = $request->token;
            $TokenCheck = Employee::where('id', $employee_id)->first();
            $DB_token = json_decode($TokenCheck->remember_token, true);
        
            if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {
                
                $result = Student::leftjoin('student_profiles', 'students.id','=','student_profiles.student_id')
                                ->select('students.first_name', 'students.last_name','students.city','students.state','students.country', 'students.gender',
                                    'students.age', 'students.date_of_birth', 'student_profiles.highest_qualification', 'student_profiles.board','student_profiles.institute')
                                ->where(['students.id' => $intern_id,'students.is_active'=> 1])
                                ->first();

                if($result != null){
                    return response()->json(['status'=>true, 'message'=>"Interns details fetched successfully", 'data'=> $result],200);
                } else {
                    return response()->json(['status'=>false, 'message'=>"No interns found"], 400);
                }
            } else {
                return response()->json(['status'=>false, 'message'=>"Unauthorzed"], 401);
            }
        } else {
            return response()->json(['status'=>false, 'message'=>"No such user"], 400);
        }
    }else {
        return response()->json(['status'=>false, 'message'=>"No such intern"], 400);
    }
}

   
//Upload profile photo
public function uploadProfilePhoto(Request $request, $id){
  
    if (Employee::where('id', $id)->exists()) {
        $user_access_token  = $request->token;
        $TokenCheck = Employee::where('id', $id)->first();
        $DB_token = json_decode($TokenCheck->remember_token, true);
 
        if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {
     
            $employerDetails = Employee::find($id);
            $profile_pic = $employerDetails->profile_pic;
            $profile_path = $employerDetails->profile_path;
            
             $validator = Validator::make($request->all(), [
                'file' => 'image|mimes:jpeg,png,jpg,gif|max:3073', 
            ]);
            
            if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Maximum image size is 3MB', 422);
             }

            if ($request->hasFile('file')) {
               $image = $request->file('file');
                $filename = $image->getClientOriginalName();
                $newfilename = $id . '_' . time() . '_' . $filename; // added
                $path = $image->storeAs('employee', $newfilename, 'public'); // Adjust the storage path as needed
                $fileSize = $image->getSize();

                // Update profile picture only if the file upload is successful
                if ($path) {
                    $userDetails = Employee::where('id', $id)->update([
                        'profile_pic' => $newfilename,
                        'profile_path' => $path,
                    ]);

                    return response()->json(['status' => true, 'message' => "Updated profile picture", 'data'=>$newfilename], 200) ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
                } else {
                    return response()->json(['status' => false, 'message' => "Error uploading profile picture"], 422);
                }
            } else {
                // No file provided, update with existing details
                $employerDetails->update([
                    'profile_pic' => $profile_pic,
                    'profile_path' => $profile_path,
                ]);
                
                return response()->json(['status' => true, 'message' => "No file provided. Profile picture remains unchanged."], 200);
            }
        } else {
            return response()->json(['status' => false, 'message' => "Unauthorized Access!!"], 401);
        }
    } else {
        return response()->json(['status' => false, 'message' => "No such employer"], 404);
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
 
   
        	$imageUrl = url('/storage/app/public/'.$fileDetails->profile_path);
         
         	return $imageUrl;
	}

  //Get employee personal info
    public function GetPersonalInfo(Request $request, $employee_id){
        
        if(Employee::where('id', $employee_id)->exists()){
            $user_access_token  = $request->token;
            $TokenCheck = Employee::where('id', $employee_id)->first();
            $DB_token = json_decode($TokenCheck->remember_token, true);
        
            if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {
                $result = Employee::select('id','first_name', 'last_name','address1','address2','email_id','phone','district', 'state',
                                            'country','pincode','gender','profile_pic','profile_path','is_active','created_at')
                                            ->where('id', $employee_id)
                                            ->first();
                if($result->profile_pic != null){
                    $employer_profile = $this->downloadProfilePhoto($result['id']);
                                                                                    
                    $employerProfileUrl = url('/api/downloadProfilePhoto/' . $result['id']);
                                                                                        
                    $employerProfilePic = [
                                    'id' => $result['id'],
                                    'download_link' => $employer_profile,
                                    ];
                                                                                        
                    $result['profilePic'] = $employer_profile;
                } else {
                    $result['profilePic'] = null;
                } 
                if($result != null){
                    return response()->json(['status'=>true, 'message'=>"Data retreived", 'data'=> $result],200);
                } else {
                    return response()->json(['status'=>false, 'message'=>"Failed to retreive data"], 422);
                }
            } else {
                return response()->json(['status'=>false, 'message' =>"Invalid token"], 401);
            }
            
        } else {
            return response()->json(['status'=>false, 'message'=>"Employee not found"], 404);
        }
    }

    //Get employee professional details
    public function GetProfessionalDetails(Request $request,$employee_id){
        if(EmployeeCompany::where('employee_id', $employee_id)->exists()){

            $user_access_token  = $request->token;
            $TokenCheck = Employee::where('id', $employee_id)->first();
            $DB_token = json_decode($TokenCheck->remember_token, true);
        
            if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {
                $result = EmployeeCompany::select('id','company_name', 'designation','company_address1','company_address2','company_district','company_state',
                                            'company_country','company_pincode')
                                            ->where('employee_id', $employee_id)
                                            ->first();
                
                if($result != null){
                    return response()->json(['status'=>true, 'message'=>"Data retreived", 'data'=> $result],200);
                } else {
                    return response()->json(['status'=>false, 'message'=>"Failed to retreive data"], 422);
                }
            } else {
                return response()->json(['status'=>false, 'message' =>"Invalid token"], 401);
            }
        } else {
            return response()->json(['status'=>false, 'message'=>"Employee not found"], 404);
        }
    }

//GEt employee profile photo
public function getEmployeeProfilePhoto(Request $request, $employee_id){

    if (Employee::where('id', $employee_id)->exists()) {
        $user_access_token  = $request->token;
        $TokenCheck = Employee::where('id', $employee_id)->first();
        $DB_token = json_decode($TokenCheck->remember_token, true);
 
        if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {

            $result = Employee::select('id','profile_pic','profile_path')->where('id', $employee_id)->first();

            if($result->profile_pic != null){

                $employer_profile = $this->downloadProfilePhoto($result['id']);
                                                                                
                $employerProfileUrl = url('/api/downloadProfilePhoto/' . $result['id']);
                                                                                    
                $employerProfilePic = [
                                'id' => $result['id'],
                                'download_link' => $employer_profile,
                                ];
                                                                                    
                $result['profilePic'] = $employer_profile;
            } else {

                $result['profilePic'] = null;
            } 
		 if($result != null){
                    return response()->json(['status'=>true, 'message'=>"Data retreived", 'data'=> $result],200);
                } else {
                    return response()->json(['status'=>false, 'message'=>"Failed to retreive data"], 422);
                }

            
        } else {
            return response()->json(['status' => false, 'message' => "Unauthorized Access!!"],401);
        } 
    }  else {
        return response()->json(['status' => false, 'message' => "No such employer"],404);
    }
}


// Employee professional details
public function UpdateEmployeeProfessionalDetails(Request $request, $employee_id){
    if(Employee::where('id', $employee_id)->exists()){
        $user_access_token  = $request->token;
        $TokenCheck = Employee::where('id', $employee_id)->first();
        $DB_token = json_decode($TokenCheck->remember_token, true);
    
        if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {

            $companyDetails = EmployeeCompany::select('*')->where('employee_id' , $employee_id)->first();

            $company_name = $request->company_name ? $request->company_name : $companyDetails->company_name;
            $company_address1 = $request->company_address1 ? $request->company_address1 : $companyDetails->company_address1;
            $company_address2 = $request->company_address2 ? $request->company_address2 : $companyDetails->company_address2;
            $company_district = $request->company_district ? $request->company_district : $companyDetails->company_district;
            $company_state = $request->company_state ? $request->company_state : $companyDetails->company_state;
            $company_country = $request->company_country ? $request->company_country : $companyDetails->company_country;
            $company_pincode = $request->company_pincode ? $request->company_pincode : $companyDetails->company_pincode;
            $designation = $request->designation ? $request->designation : $companyDetails->designation;

            $result = EmployeeCompany::where('employee_id', $employee_id)->update([
                'company_name' => $company_name,
                'company_address1' => $company_address1,
                'company_address2' => $company_address2,
                'company_district' => $company_district,
                'company_state' => $company_state,
                'company_country' => $company_country,
                'company_pincode' => $company_pincode,
                'designation' => $designation,
            ]);

            if($result == true){

                $profile_completion = Employee::where('id', $employee_id)->update([
                    'is_completed' => 1
                ]);

                return response()->json(['status' => true, 'message' => "Professional details added successfully"], 200);
            } else {
                return response()->json(['status' => false, 'message' =>"Failed to add details"], 200);
            }
        } else {
            return response()->json(['status' => false, 'message' => "Invalid token"], 401);
        }
    } else {
        return response()->json(['status' => false, 'message' => "Employee not found"], 400);
    }

}


 //Forgot password
    public function resetPassword(Request $request){
        $email = $request->email;

        if(Employee::where('email_id', $email)->exists()){

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return $this->sendError('Email is not valid', 'Email is not valid',422);
            } else {
                list($user, $domain) = explode('@', $email);
                if (!checkdnsrr($domain, 'MX')) {
                    return $this->sendError('Invalid email domain', 'Invalid email domain', 422);
                }
            }
            
            $new_password = Hash::make($request->new_password); 
            $result = Employee::where('email_id', $email)->update([
                'password' => $new_password
            ]);

            if($result = true){
                return response()->json(['status'=>true, 'message'=>"Password reseted successfully"],200);
            } else {
                return response()->json(['status'=>false, 'message'=>"Failed to reset password"],200);
            }


        } else {
            return response()->json(['status' => false, 'message' => "No such user"], 404);
        }
    }

	 //Dashboard
    public function dashboard(Request $request, $employer_id){

        $user_access_token  = $request->token;
        $TokenCheck = Employee::where('id', $employer_id)->first();
        $DB_token = json_decode($TokenCheck->remember_token, true);
     
        if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {

            $interns = Student::select('*')->where('is_active', 1)->count();
            $tasks = EmployeeTask::select('*')->where('created_by', $employer_id)->count();
            $select_interns = SelectIntern::select('*')->where(['employer_id' => $employer_id, 'is_selected'=>1])->count();

            $data = [
                'interns' => $interns,
                'tasks' => $tasks,
                'selected_interns' => $select_interns
            ];

           return response()->json(['status' => true, 'message' => "Data retreived", 'data'=> $data]);
        } else {
            return response()->json(['status' => false, 'message' => "Invalid token"]);
        }
    }
    
    //List tasks
    public function ListTasks(Request $request, $employee_id){

        $user_access_token  = $request->token;
        $TokenCheck = Employee::where('id', $employee_id)->first();
        $DB_token = json_decode($TokenCheck->remember_token, true);
     
        if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {

            $result = EmployeeTask::select('task_id','task_name','task_desc','time','created_at')->where('created_by', $employee_id)->get();

            if($result == true){
                return response()->json(['status'=>true, 'message'=>"Data retreived", 'data'=>$result]);
            } else {
                return response()->json(['status'=>true, 'message' => "Empty data", 'data'=>$result]);
            }

        } else {
            return response()->json(['status'=>true, 'message'=>"Not authorized"]);
        }

    }

    //Get tasks  by id
    public function getTasksById(Request $request, $employee_id){

        $task_id = $request->task_id;

        $user_access_token  = $request->token;
        $TokenCheck = Employee::where('id', $employee_id)->first();
        $DB_token = json_decode($TokenCheck->remember_token, true);
 
        if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {

            $result = EmployeeTask::select('task_id','task_name','task_desc','time','created_at')
                                    ->where(['created_by'=> $employee_id, 'task_id' => $task_id])
                                    ->first();
   

            $taskAttchmentCount = EmployeeTaskAttachment::where(['task_id'=> $task_id])->count('*');
             
            $attachment = EmployeeTaskAttachment::select('id', 'file_name')->where(['task_id'=> $task_id])->get();
                                   
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
                  
                ];
            }

            $result['attachments'] = $attachmentData;

            if($result != null){
                return response()->json(['status'=>true, 'message'=>"Data retreived", 'data'=> $result]);
            } else {
                return response()->json(['status'=>false, 'message'=>"No data found", 'data'=>$result]);
            }
        } else {
            return response()->json(['status'=>false, 'message'=>"Unauthorized"]);
        }

    } 

    public function download($id){
        $fileDetails = EmployeeTaskAttachment::find($id);
    
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
    

    //Assign tasks to intern
    public function AssignTaskToIntern(Request $request, $employee_id){

        $task_id = $request->task_id;
        $intern_id = $request->intern_id;
        $user_access_token  = $request->token;
        $TokenCheck = Employee::where('id', $employee_id)->first();
        $DB_token = json_decode($TokenCheck->remember_token, true);
     
        if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {

            $result = AssignEmployerTask::insert([
                'task_id' => $task_id,
                'intern_id' => $intern_id,
                'employer_id' => $employee_id,
                'status' => -1,
                'answer' => "Not asnwered",
                'is_answered' => 0,
                'created_at' => date('Y-m-d')
            ]);

            if($result == true){
                return response()->json(['status'=>true, 'message'=>"Assign task to this intern"]);
            } else {
                return response()->json(['status'=>false, 'message'=>"Failed to assign task"]);
            }

        } else {
            return response()->json(['status'=>false, 'message'=>"Unauthorized"]);
        }

    }


    //List task assigned
    public function ListTaskAssigned(Request $request, $employee_id){

        $user_access_token  = $request->token;
        $TokenCheck = Employee::where('id', $employee_id)->first();
        $DB_token = json_decode($TokenCheck->remember_token, true);
     
        if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {

            $result = AssignEmployerTask::leftjoin('employee_tasks', 'employee_tasks.task_id', '=', 'assign_employer_tasks.task_id')
                    ->leftjoin('students', 'students.id', '=', 'assign_employer_tasks.intern_id')
                    ->select(
                        'employee_tasks.id',
                        'employee_tasks.task_name',
                        'employee_tasks.task_desc',
                        'students.id as student_id',
                        'students.first_name',
                        'students.last_name',
                        'assign_employer_tasks.created_at as assigned_date',
                        'assign_employer_tasks.status',
                        'assign_employer_tasks.is_answered',
                        'assign_task_employer.answer',
              
                        \DB::raw("
                            CASE 
                                WHEN assign_employer_tasks.status = -1 THEN 'Pending'
                                WHEN assign_employer_tasks.status = 0 THEN 'Rejected'
                                WHEN assign_employer_tasks.status = 1 THEN 'Approved'
                                ELSE 'Unknown'
                            END AS status_description
                        ")
                    )
                    ->where([
                        'assign_employer_tasks.employer_id' => $employee_id,
                        
                    ])
                    ->get();

            
           if($result != null){

                return response()->json(['status'=>true, 'message'=>"Data retreived", 'data'=>$result]);
           } else {
                return response()->json(['status'=>false, 'message'=>"Data not retreived", 'data'=>$result]);
           }

        } else {
            return response()->json(['status'=>true, 'message'=>"Unauthorized"]);
        }
        
    }


    //View assigned tasks

    public function ViewTaskAssigned(Request $request, $employee_id){

        $intern_id = $request->intern_id;
        $task_id = $request->task_id;
        $user_access_token  = $request->token;
        $TokenCheck = Employee::where('id', $employee_id)->first();
        $DB_token = json_decode($TokenCheck->remember_token, true);
     
        if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {

            $result = $result = AssignEmployerTask::leftjoin('employee_tasks', 'employee_tasks.task_id', '=', 'assign_employer_tasks.task_id')
                                ->leftjoin('students', 'students.id', '=', 'assign_employer_tasks.intern_id')
                                ->select(
                                    'employee_tasks.task_id',
                                    'employee_tasks.task_name',
                                    'employee_tasks.task_desc',
                                    'students.id as student_id',
                                    'students.first_name',
                                    'students.last_name',
                                    'assign_employer_tasks.created_at as assigned_date',
                                    'assign_employer_tasks.status',
                                    'assign_employer_tasks.is_answered',
                                    'assign_task_employer.answer',
                                    
                                    \DB::raw("
                                        CASE 
                                            WHEN assign_employer_tasks.status = -1 THEN 'Not Answered'
                                            WHEN assign_employer_tasks.status = 0 THEN 'Rejected'
                                            WHEN assign_employer_tasks.status = 1 THEN 'Approved'
                                            ELSE 'Unknown'
                                        END AS status_description
                                    ")
                                )
                                ->where([
                                    'assign_employer_tasks.employer_id' => $employee_id,
                                    'assign_employer_tasks.task_id' => $task_id,
                                    'assign_employer_tasks.intern_id' => $intern_id
                                ])
                                ->get();
                            
            
           if($result != null){

                return response()->json(['status'=>true, 'message'=>"Data retreived", 'data'=>$result]);
           } else {
                return response()->json(['status'=>false, 'message'=>"Data not retreived", 'data'=>$result]);
           }

        } else {
            return response()->json(['status'=>true, 'message'=>"Unauthorized"]);
        }
        
    }

    //Approve or reject tasks
    public function ApproveOrRejectTask(Request $request, $employee_id){

        $intern_id = $request->intern_id;
        $task_id = $request->task_id;
        $status = $request->status;
        $user_access_token  = $request->token;
        $TokenCheck = Employee::where('id', $employee_id)->first();
        $DB_token = json_decode($TokenCheck->remember_token, true);
     
        if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {

            $result = AssignEmployerTask::where(['assign_employer_tasks.employer_id'=> $employee_id, 'assign_employer_tasks.task_id' => $task_id, 'assign_employer_tasks.intern_id' => $intern_id])
                                          ->update([
                                            'status' => $status
                                          ]);

           if($result == true){
              if($status == 1){
                return response()->json(['status'=>true, 'message'=>"Answer approved"]);
              } else {
                return response()->json(['status'=>true, 'message'=>"Answer rejected"]);
              }
           } else {
             return response()->json(['status'=>false, 'message'=>"Failed to update"]);
           }

        } else {
            return response()->json(['status'=>false, 'message'=>"Unauthorized"]);
        }
    }

    //Selected Intern
    public function SelectIntern(Request $request, $employee_id){

        $intern_id = $request->intern_id;
        $user_access_token  = $request->token;
        $TokenCheck = Employee::where('id', $employee_id)->first();
        $DB_token = json_decode($TokenCheck->remember_token, true);
     
        if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {

            $result = SelectIntern::insert([
                'intern_id' => $intern_id,
                'employer_id' => $employee_id,
                'is_selected' => 1,
                'created_at'=> date('Y-m-d')
            ]);

            if($result = true){
                return response()->json(['status'=>true, 'message'=>"Intern Selected"]);
            } else {
                return response()->json(['status'=>false, 'message'=>"Failed to select intern"]);
            }
    
        } else {
            return response()->json(['status'=>false, 'message'=>"Unathurized"]);
        }
    }

    //List selected interns
    public function ListSelectedInterns(Request $request, $employee_id){

        $user_access_token  = $request->token;
        $TokenCheck = Employee::where('id', $employee_id)->first();
        $DB_token = json_decode($TokenCheck->remember_token, true);
     
        if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {

            $result = SelectIntern::leftjoin('students','students.id','=','select_interns.intern_id')
                                    ->select('select_interns.id','students.first_name','students.last_name','students.email_id','students.country')
                                    ->where(['select_interns.employer_id'=> $employee_id, 'select_interns.is_selected' => 1])
                                    ->get();

            if($result = true){
                return response()->json(['status'=>true, 'message'=>"Data retreived", 'data'=>$result]);
            } else {
                return response()->json(['status'=>false, 'message'=>"Failed to retreive data", 'data'=>$result]);
            }

        } else {
            return response()->json(['status'=>false, 'message'=>"Unauthorized"]);
        }

    }
 
}
