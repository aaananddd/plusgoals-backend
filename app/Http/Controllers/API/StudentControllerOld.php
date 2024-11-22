<?php

namespace App\Http\Controllers\API;

// use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\StudentProfile;
use App\Models\StudentDetail;
use App\Models\StudentCategory;
use App\Models\Course;
use App\Models\Level;
use App\Models\DifficultyLevel;
use App\Models\CourseTopic;
use App\Models\StudentTask;
use App\Models\RequestForInternContact;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Laravel\Sanctum\HasApiTokens;
use Session;

class StudentController extends Controller
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

    // Student register
    public function register(Request $request)
    {
        $input = $request->only('first_name', 'last_name', 'email', 'phone', 'password', 'c_password');

        $validator = Validator::make($input, [
            'first_name' => 'required',
            'last_name' => 'required',
            //  'email' => 'required|email|unique:users',
            'phone' => 'required|min:10|max:12',
            'password' => 'required|min:6',
            'c_password' => 'required|same:password',
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

        $emailCheck = Student::select('*')->where('email_id', $request->email)->first();

        if ($emailCheck == null) {
            $user = Student::insert([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email_id' => $request->email,
                'phone' => $request->phone,
                'password' => $password,
                'is_active' => 1,
                'created_at' => date('Y-m-d'),
                'is_completed' => 0
            ]); // eloquent creation of data

            $ApplyCourse = StudentDetail::insert([
                'student_id' => $user,
                'course_id' => '1',
                'level_id' => '1',
                'mode' => "Free",
                'difficulty_level' => '1',
                'level_status' => "Open",
                'created_at' => date('Y-m-d'),
                
            ]);
    
            $success['student'] = $user;

            //  return $this->sendResponse($success, 'Student registered successfully', 201);
            return response()->json(['status' => true, 'message' => "Student registered successfully"]);
        } else {
            return response()->json(['status' => false, 'message' => "User already exists"]);
        }


    }

    // Student login

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
	$result = Student::where('email_id', $request->email)->first();

	if ($result) {
    // Fetch existing remember tokens
    	$rememberTokens = json_decode($result->remember_token, true);

    // Limit the remember tokens to 4
    	$rememberTokens[] = $token;
    	if (count($rememberTokens) > 4) {
        // Remove the oldest token
        	array_shift($rememberTokens);
    	}

    // Update user's remember tokens
    	Student::where('email_id', $request->email)->update(['remember_token' => json_encode($rememberTokens)]);

    // Check password
    	$hashedPassword = $result->password;
    	if (Hash::check($request->password, $hashedPassword)) {
        	$educational_details = StudentProfile::where('student_id', $result->id)->exists();

        $success = [
            'token' => $token,
            'email_id' => $request->email,
            'name' => $result->first_name,
            'id' => $result->id,
            'is_completed' => $result->is_completed,
            'educational_details' => $educational_details
        ];
        	return $this->sendResponse($success, 'successful login', 200);
    	} else {
        	return response()->json(['status' => false, 'message' => "Invalid credentials"]);
    	}
	} else {
    		return response()->json(['status' => false, 'message' => "No such user"]);
	}
    }
    
   
    //logout 
    public function logout($id)
    {

        if (Student::where('id', $id)->exists()) {

            $result = Student::where('id', $id)->update([
                'remember_token' => null
            ]);

            if ($result == true) {
                return response()->json(['status' => 200, 'message' => "Logged out"]);
            } else {
                return response()->json(['status' => false, 'message' => "Failed to log out"]);
            }
        }

    }


    public function updateProfile(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        // 'user_id' => 'required',
        'address1' => 'required',
        'city' => 'required',
        'state' => 'required',
        'country' => 'required',
        'pincode' => 'required'
    ]);

    if ($validator->fails()) {
        $msg = $validator->messages()->first();
        return response()->json(['response_code' => false, 'message' => $msg]);
    }

    $user_id = $request->user_id;
    if (Student::where('id', $id)->exists()) {
	$user_access_token  = $request->token;
        $TokenCheck = Student::where('id', $id)->first();
        $DB_token = json_decode($TokenCheck->remember_token, true);
     
        if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {
    
            $UserCheck = Student::select('*')->where('id', $id)->first();

            if ($UserCheck != null) {
                $first_name = $request->first_name ? $request->first_name : $UserCheck->first_name;
                $last_name = $request->last_name ? $request->last_name : $UserCheck->last_name;
                $address1 = $request->address1 ? $request->address1 : $UserCheck->address1;
                $address2 = $request->address2 ? $request->address2 : $UserCheck->address2;
                $city = $request->city ? $request->city : $UserCheck->city;
                $district = $request->district ? $request->district : $UserCheck->district;
                $state = $request->state ? $request->state : $UserCheck->state;
                $country = $request->country ? $request->country : $UserCheck->country;
                $phone = $request->phone ? $request->phone : $UserCheck->phone;
                $pincode = $request->pincode ? $request->pincode : $UserCheck->phone;
                $gender = $request->gender ?  $request->gender  : $UserCheck->gender ;
                $date_of_birth = $request->date_of_birth ? $request->date_of_birth : $UserCheck->date_of_birth;
                $age = $request->age ? $request->age : $UserCheck->age;

                // Randomly assign instructor
                $instructor = User::where('role', 2)->inRandomOrder()->first();
                if ($instructor) {
                    // Update user profile
                    $updateProfile = Student::where('id', $id)->update([
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        'address1' => $address1,
                        'address2' => $address2,
                        'city' => $city,
                        'district' => $district,
                        'state' => $state,
                        'country' => $country,
                        'phone' => $phone,
                        'pincode' => $pincode,
                        'gender' => $gender,
                        'age' => $age,
                        'date_of_birth' => $date_of_birth,
                        'is_active' => '1',
                        'is_completed' => 1,
                        'instructor_id' => $instructor->id // Assign instructor
                    ]);

                    if ($updateProfile==true) {
                        return response()->json(['status' => true, 'message' => "Updated user details successfully"]);
                    } else {
                        return response()->json(['status' => false, 'message' => "Failed to update"]);
                    }
                } else {
                    return response()->json(['status' => false, 'message' => "No instructor available"]);
                }
            } else {
                return response()->json(['status' => false, 'message' => "No such user exists"]);
            }
        } else {
            return response()->json(['status' => false, 'message' => 'Invalid token']);
        }
    } else {
        return response()->json(['status' => false, 'message' => "No such user"]);
    }
}

//Upload profile photo
    public function uploadProfilePhoto(Request $request, $id){
        if (Student::where('id', $id)->exists()) {
            $user_access_token  = $request->token;
            $TokenCheck = Student::where('id', $id)->first();
            $DB_token = json_decode($TokenCheck->remember_token, true);
     
            if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {
         
                $studentDetails = Student::find($id);
                $profile_pic = $studentDetails->profile_pic;
                $profile_path = $studentDetails->profile_path;
                
                 $validator = Validator::make($request->all(), [
                    'file' => 'image|mimes:jpeg,png,jpg,gif|max:3073', 
                ]);
                
                if ($validator->fails()) {
                return $this->sendError($validator->errors(), 'Maximum image size is 3MB', 422);
                 }
    
                if ($request->hasFile('file')) {
                     $image = $request->file('file');
		     $filename = $image->getClientOriginalName();
                     $newfilename = $id . '_' . time() . '_' . $filename; // Adjust the filename format as needed
                     $path = $image->storeAs('student', $newfilename, 'public'); // Store in the 'student' folder
    
                    // Update profile picture only if the file upload is successful
                    if ($path) {
                        $userDetails = Student::where('id', $id)->update([
                            'profile_pic' => $newfilename,
                            'profile_path' => $path,
                        ]);
    
                        return response()->json(['status' => true, 'message' => "Updated profile picture", 'data'=>$newfilename], 200) ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
                    } else {
                        return response()->json(['status' => false, 'message' => "Error uploading profile picture"], 422);
                    }
                } else {
                    // No file provided, update with existing details
                    $studentDetails->update([
                        'profile_pic' => $profile_pic,
                        'profile_path' => $profile_path,
                    ]);
                    
                    return response()->json(['status' => true, 'message' => "No file provided. Profile picture remains unchanged."], 200);
                }
            } else {
                return response()->json(['status' => false, 'message' => "Unauthorized Access!!"], 401);
            }
        } else {
            return response()->json(['status' => false, 'message' => "No such warrior"], 404);
        }
    }

	
//Download Profile photo
	public function downloadProfilePhoto($fileId)
	{
    		$fileDetails = Student::find($fileId);
  
    		if(!$fileDetails) {
        
        	$content = "File not found";
        	return $content;
    		}

             if(($fileDetails->profile_path) != null){

    		$filePath = public_path("/{$fileDetails->profile_path}");

        	$imageUrl = url('/storage/app/public/'.$fileDetails->profile_path);
         
         	return $imageUrl;
            } else {
		
		$imageUrl = null;
		return $imageUrl;

	   }
	}


//Download Profile photo
	public function InternProfilePhoto($fileId)
	{
    		$fileDetails = Student::find($fileId);
  
    		if(!$fileDetails) {
        
        	$content = "File not found";
        	return $content;
    		}

             if(($fileDetails->profile_path) != null){

    		$filePath = public_path("/{$fileDetails->profile_path}");

        	$imageUrl = url('/storage/app/public/'.$fileDetails->profile_path);
		
		$data = [
		    'id' => $fileId,
		    'profile_pic' => $imageUrl,
		    'profile_path' => $imageUrl,
		    'profilePic' => $imageUrl
		];
         
         	return response()->json(['status'=>true, 'message'=>"Profile url", 'data' =>$data],200);
            } else {
		
		$data = [
		    'id' => $fileId,
		    'profile_pic' => null,
		    'profile_path' => null,
		    'profilePic' => null
		];
		return response()->json(['status'=>false, 'message'=>"No profile url available",'data'=>$data], 422);

	   }
	}


    //Insert Student educational details
    public function insertStudentProfile(Request $request, $id)
    {

        if (Student::where('id', $id)->exists()) {
	    $user_access_token  = $request->token;
        $TokenCheck = Student::where('id', $id)->first();
        $DB_token = json_decode($TokenCheck->remember_token, true);
     
        if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {
         
                $student_id = $id;

	   if(StudentProfile::where('student_id', $student_id)->exists()){

		 $studentDetails = StudentProfile::select('*')->where('student_id', $student_id)->first();

                $year_of_passing = $request->year_of_passing ? $request->year_of_passing :  $studentDetails->year_of_passing;
                $highest_qualification = $request->highest_qualification ? $request->highest_qualification :  $studentDetails->highest_qualification;
                $institute = $request->institute ? $request->institute :  $studentDetails->institute;
                $board = $request->board ? $request->board : $studentDetails->board;
                $total_marks = $request->total_marks ? $request->total_marks : $studentDetails->total_marks;
                $additional_qualification = $request->additional_qualification ? $request->additional_qualification : $studentDetails->additional_qualification;
                $experience = $request->experience ? $request->experience : $studentDetails->experience;
                $skills = $request->skills ? $request->skills : $studentDetails->skills;
                $expected_salary = $request->expected_salary ? $request->expected_salary : $studentDetails->expect_salary;

                $result = StudentProfile::where('student_id', $student_id)->update([
                    'year_of_passing' => $year_of_passing,
                    'highest_qualification' => $highest_qualification,
                    'institute' => $institute,
                    'board' => $board,
                    'total_marks' => $total_marks,
                    'additional_qualification' => $additional_qualification,
                    'experience' => $experience,
                    'skills' => $skills,
                    'expected_salary' => $expected_salary,
                ]);

                if ($result = true) {
                    return response()->json(["status" => true, "message" => "Updated Educational details successfully"]);
                } else {
                    return response()->json(["status" => false, 'message' => "Failes to update"]);
                }
	   } else {

                $year_of_passing = $request->year_of_passing;
                $highest_qualification = $request->highest_qualification;
                $institute = $request->institute;
                $board = $request->board;
                $total_marks = $request->total_marks;
                $additional_qualification = $request->additional_qualification;
                $experience = $request->experince;
                $skills = $request->skills;
                $expected_salary = $request->expected_salary;

               $randomInstructor = User::where('role', 2)
                        ->where('is_active', 1)
                        ->inRandomOrder()
                        ->first();

		if ($randomInstructor) {
    		     	$randomInstructorId = $randomInstructor->id;
   	 	} else {
    			$randomInstructorId = 1;
		}

                $result = StudentProfile::insert([
                    'student_id' => $student_id,
                    'year_of_passing' => $year_of_passing,
                    'highest_qualification' => $highest_qualification,
                    'institute' => $institute,
                    'board' => $board,
                    'total_marks' => $total_marks,
                    'instructor_id' => $randomInstructorId,
                    'created_at' => date('Y-m-d'),
                    'educational_details' => 1,
                    'additional_qualification' => $additional_qualification,
                    'experience' => $experience,
                    'skills' => $skills,
                    'expected_salary' => $expected_salary
                ]);

                if ($result = true) {


                    $ApplyCourse = StudentDetail::insert([
                        'student_id' => $id,
                        'course_id' => '1',
                        'level_id' => '1',
                        'mode' => "Free",
                        'difficulty_level' => '1',
                        'level_status' => "Open",
                        'created_at' => date('Y-m-d'),

                    ]);
                  
		    return response()->json(["status" => true, "message" => "Record inserted successfully"]);
                } else {
                    return response()->json(["status" => false, 'message' => "Failes to update"]);
                }
	      }
            } else {
                return response()->json(["status" => false, 'message' => "Invalid token"]);
            }
        } else {
            return response()->json(["status" => false, 'message' => "No such student exists"]);
        }
    }

    //Update Student educational details
    public function updateStudentProfile(Request $request, $id)
    {

        if (Student::where('id', $id)->exists()) {
        $user_access_token  = $request->token;
        $TokenCheck = Student::where('id', $id)->first();
        $DB_token = json_decode($TokenCheck->remember_token, true);
     
        if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {
          
            $student_id = $id;
            $studentDetails = StudentProfile::select('*')->where('student_id', $student_id)->first();

                $year_of_passing = $request->year_of_passing ? $request->year_of_passing :  $studentDetails->year_of_passing;
                $highest_qualification = $request->highest_qualification ? $request->highest_qualification :  $studentDetails->highest_qualification;
                $institute = $request->institute ? $request->institute :  $studentDetails->institute;
                $board = $request->board ? $request->board : $studentDetails->board;
                $total_marks = $request->total_marks ? $request->total_marks : $studentDetails->total_marks;
                $additional_qualification = $request->additional_qualification ? $request->additional_qualification : $studentDetails->additional_qualification;
                $experience = $request->experience ? $request->experience : $studentDetails->experience;
                $skills = $request->skills ? $request->skills : $studentDetails->skills;
                $expected_salary = $request->expected_salary ? $request->expected_salary : $studentDetails->expect_salary;

                $result = StudentProfile::where('student_id', $student_id)->update([
                    'year_of_passing' => $year_of_passing,
                    'highest_qualification' => $highest_qualification,
                    'institute' => $institute,
                    'board' => $board,
                    'total_marks' => $total_marks,
                    'additional_qualification' => $additional_qualification,
                    'experience' => $experience,
                    'skills' => $skills,
                    'expected_salary' => $expected_salary,
                ]);

                if ($result = true) {
                    return response()->json(["status" => true, "message" => "Updated Educational details successfully"]);
                } else {
                    return response()->json(["status" => false, 'message' => "Failes to update"]);
                }
            } else {
                return response()->json(["status" => false, 'message' => "Invalid token"]);
            }
        } else {
            return response()->json(["status" => false, 'message' => "No such student exists"]);
        }
    }

    // Student apply a course
    public function applyCourse(Request $request, $id)
    {

        if (Student::where('id', $id)->exists()) {
	$user_access_token  = $request->token;
        $TokenCheck = Student::where('id', $id)->first();
        $DB_token = json_decode($TokenCheck->remember_token, true);
     
        if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {
           // $token = Student::select('remember_token')->where('id', $id)->get();
           // if (($token[0]->remember_token) == ($request->token)) {

                $course_id = $request->course_id;
                $courseDetails = Course::select('*')->where('id', $course_id)->get();
                $mode = $courseDetails[0]->mode;

                $studentCourse = StudentDetail::select('*')->where(['student_id' => $id, 'course_id' => $course_id])->get();
                if ((count($studentCourse)) > 0) {
                    return response()->json(['status' => false, 'message' => "Student has already applied to this course"]);
                } else {
                    $result = StudentDetail::insert([
                        'student_id' => $id,
                        'course_id' => $course_id,
                        'level_id' => '1',
                        'mode' => $mode,
                        'difficulty_level' => '1',
                        'level_status' => "start",
                        'created_at' => date('Y-m-d'),

                    ]);

                    if ($result = true) {
                        return response()->json(['status' => true, 'message' => "Applied to course successfully"]);
                    } else {
                        return response()->json(['status' => false, 'message' => "Failed to update"]);
                    }
                }
            } else {
                return response()->json(['status' => false, 'message' => "Invalid token"]);
            }
        } else {
            return response()->json(['status' => false, 'message' => "No such student found"]);
        }
    }


    //Get students details
    public function getStudentDetails()
    {
        $user = Session::get('user');
        $user_id = $user->id;
        $role = User::select('role')->where('id', $user_id)->first();
        if($role->role == 1){
            $result = StudentProfile::leftjoin('students', 'students.id', '=', 'student_profiles.student_id')
            ->leftjoin('student_details', 'student_profiles.student_id', '=', 'student_details.student_id')
            ->leftjoin('levels', 'student_details.level_id', '=', 'levels.id')
            ->leftjoin('users', 'users.id','=','students.instructor_id')
            ->leftjoin('student_categories', 'students.student_category','=','student_categories.id')
            ->where('students.is_active', '1')
            ->orderby('students.created_at', 'desc')
            ->select('students.*', 'levels.level_name', 'users.first_name as instructor_first_name', 'users.last_name as instructor_last_name','student_categories.category_name as student_category')  
	        ->distinct()
            ->paginate();
        } else {
            $result = StudentProfile::leftjoin('students', 'students.id', '=', 'student_profiles.student_id')
            ->leftjoin('student_details', 'student_profiles.student_id', '=', 'student_details.student_id')
            ->leftjoin('levels', 'student_details.level_id', '=', 'levels.id')
            ->where(['students.is_active'=> '1', 'students.instructor_id' => $user_id])
            ->orderby('students.created_at', 'desc')
            ->select('students.*', 'levels.level_name')  
	        ->distinct()
            ->paginate();
        }


        if (!empty($result)) {
            return view('student_list', ['data' => array($result)]);
            // return response()->json(['status'=>true, 'message'=>"Data retreived", 'data'=>$result]);
        } else {
            return response()->json(['status' => false, 'message' => "Failed to retreive"]);
        }

    }

    //Get student details by id
    public function getStudentDetailById(Request $request, $id)
    {
	$user_access_token  = $request->token;
        $TokenCheck = Student::where('id', $id)->first();
        $DB_token = json_decode($TokenCheck->remember_token, true);
     
        if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {
       // if (Student::where('remember_token', $request->token)->exists()) {
            $result = Student::leftjoin('student_profiles', 'students.id', '=', 'student_profiles.student_id')
                ->leftjoin('student_details', 'student_profiles.student_id', '=', 'student_details.student_id')
                ->leftjoin('courses', 'student_details.course_id', '=', 'courses.id')
                ->select(
                    'students.id as id',
                    'students.first_name',
                    'students.last_name',
                    'students.email_id',
                    'students.address1',
                    'students.address2',
                    'students.phone',
                    'students.district',
                    'students.city',
                    'students.state',
                    'students.country',
                    'students.pincode',
                    'student_profiles.highest_qualification',
                    'student_profiles.institute',
                    'student_profiles.year_of_passing',
                    'student_profiles.total_marks',
                    'student_details.mode',
                    'student_details.level_status',
                    'courses.course_name',
                    'courses.course_desc',
                    'students.is_completed',
                    'student_profiles.educational_details'
                )
                ->where('students.id', $id)
                ->orderby('students.id', 'asc')
                ->get(['students.*', 'student_profiles.*', 'student_details.*', 'courses.course_name']);
            if ($result != null) {
                return response()->json(['status' => true, 'message' => "Data retreived", 'data' => $result]);
            } else {
                return response()->json(['status' => false, 'message' => "Failed to retreive"]);
            }
        }

    }

    //Get paid students details
    public function getPaidStudents()
    {

        $result = User::leftjoin('student_profiles', 'users.id', '=', 'student_profiles.student_id')
            ->leftjoin('courses', 'student_profiles.course_id', '=', 'courses.id')
            ->where('users.is_student', '1')
            ->where('student_profiles.mode', "Paid")
            ->get(['users.*', 'student_profiles.*', 'courses.course_name']);

        if ($result != null) {
            return view('paid_Students', ['data' => array($result)]);
            return response()->json(['status' => true, 'message' => "Data retreived", 'data' => $result]);
        } else {
            return response()->json(['status' => false, 'message' => "Failed to retreive"]);
        }

    }


    //Get unpaid students details
    public function getUnPaidStudents()
    {

        $result = Student::leftjoin('student_profiles', 'users.id', '=', 'student_profiles.student_id')
            ->leftjoin('courses', 'student_profiles.course_id', '=', 'courses.id')
            ->where('users.is_student', '1')
            ->where('student_profiles.mode', "Free")
            ->get(['users.*', 'student_profiles.*', 'courses.course_name']);

        if ($result != null) {
            return view('unpaid_Students', ['data' => array($result)]);
            return response()->json(['status' => true, 'message' => "Data retreived", 'data' => $result]);
        } else {
            return response()->json(['status' => false, 'message' => "Failed to retreive"]);
        }
    }

    //student profile details
    public function studentProfile(Request $request, $id)
    {

          if (Student::where('id', $id)->exists()) {
            $user_access_token  = $request->token;
                $TokenCheck = Student::where('id', $id)->first();
                $DB_token = json_decode($TokenCheck->remember_token, true);
             
                if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {
                 $result = Student::leftJoin('student_profiles', 'students.id', '=', 'student_profiles.student_id')
    ->select('students.id', 'students.first_name', 'students.last_name', 'students.email_id', 'students.phone', 'students.address1',
        'students.address2', 'students.district', 'students.state', 'students.country', 'students.age', 'students.gender', 'students.date_of_birth',
        'students.profile_pic', 'students.profile_path', 'student_profiles.student_id', 'student_profiles.highest_qualification', 'student_profiles.institute',
        'student_profiles.board', 'student_profiles.total_marks', 'student_profiles.year_of_passing', 'student_profiles.educational_details', 'student_profiles.additional_qualification',
        'student_profiles.experience', 'student_profiles.expected_salary', 'student_profiles.skills')
    ->where('students.id', $id)
    ->first();

if ($result->profile_pic != null) {
    $student_profile = $this->downloadProfilePhoto($result->id);
    $studentProfileUrl = url('/api/downloadProfilePhoto/' . $result->id);

    $result->profilePic = $student_profile; // Directly add `profilePic` to `$result`
} else {
    $result->profilePic = null;
}
        if ($result == true) {
                            return response()->json(['status' => true, 'message' => "Data retreived successfully", 'data' => $result]);
                        } else {
                            return response()->json(['status' => false, 'message' => "Failed to retreive data"]);
                        }
                       
                    } else {
                        return response()->json(['status' => false, 'message' => 'Invalid token']);
                    }
                } else {
                    return response()->json(['status' => false, 'message' => "No such user"]);
                }
    }

    //student educational details
    public function studentEducationalDetails(Request $request, $id)
    {

        if (Student::where('id', $id)->exists()) {
	$user_access_token  = $request->token;
        $TokenCheck = Student::where('id', $id)->first();
        $DB_token = json_decode($TokenCheck->remember_token, true);
     
        if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {
        //    $user_access_token = $request->token; 
        //    $TokenCheck = Student::where('id', $id)->first();
        //    $DB_token = $TokenCheck->remember_token;
       //     if ($DB_token == $user_access_token) {
                $result = StudentProfile::select('*')->where('student_id', $id)->first();
                if ($result == true) {
                    return response()->json(['status' => true, 'message' => "Data retreived successfully", 'data' => $result]);
                } else {
                    return response()->json(['status' => false, 'message' => "Failed to retreive data"]);
                }
            } else {
                return response()->json(['status' => false, 'message' => 'Invalid token']);
            }
        } else {
            return response()->json(['status' => false, 'message' => "No such user"]);
        }
    }

    //Update student details table
    public function updateStudentDetails(Request $request, $id)
    {
        if (Student::where('id', $id)->exists()) {
	$user_access_token  = $request->token;
        $TokenCheck = Student::where('id', $id)->first();
        $DB_token = json_decode($TokenCheck->remember_token, true);
     
        if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {
        //    $user_access_token = $request->token;
        //    $TokenCheck = Student::where('id', $id)->first();
         //   $DB_token = $TokenCheck->remember_token;
        //    if ($DB_token == $user_access_token) {
                $UserDetails = StudentDetail::select('*')->where('student_id', $id)->get();

                $course_id = $request->course_id ? $request->course_id : $UserDetails[0]->course_id;
                $level_id = $request->level_id ? $request->level_id : $UserDetails[0]->course_id;
                $mode = $request->mode ? $request->mode : $UserDetails[0]->mode;
                $difficulty_level = $request->difficulty_level ? $request->difficulty_level : $UserDetails[0]->difficulty_level;
                $level_status = $request->level_status ? $request->level_status : $UserDetails[0]->level_status;
                $task_id = $request->task_id ? $request->task_id : $UserDetails[0]->task_id;

                $result = StudentDetail::insert([
                    'student_id' => $id,
                    'course_id' => $course_id,
                    'level_id' => '1',
                    'mode' => $mode,
                    'difficulty_level' => '1',
                    'level_status' => "start",
                    'created_at' => date('Y-m-d'),

                ]);

                if ($result = true) {
                    return response()->json(['status' => true, 'message' => "Updated successfully"]);
                } else {
                    return response()->json(['status' => false, 'message' => "Failed to update"]);
                }
            } else {
                return response()->json(['status' => false, 'message' => 'Invalid token']);
            }
        } else {
            return response()->json(['status' => false, 'message' => "No such user"]);
        }

    }

    //Student Dashboard details
    public function StudentDashboard(Request $request, $id)
    {
	$user_access_token  = $request->token;
        $TokenCheck = Student::where('id', $id)->first();
        $DB_token = json_decode($TokenCheck->remember_token, true);
     
        if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {
         $result = Student::leftjoin('student_details', 'students.id', '=', 'student_details.student_id')
                ->leftjoin('courses', 'courses.id', '=', 'student_details.course_id')
                ->select('students.first_name', 'students.last_name', 'students.email_id', 'student_details.level_id as level_id', 'student_details.difficulty_level as difficulty_level', 'courses.id as course_id', 'courses.course_name', 'courses.course_desc')
                ->where('students.id', $id)
                ->get();

            $tasksCompleted = StudentTask::where(['student_id' => $id, 'task_status' => 'Completed'])->count('*');

            $completedLevel = StudentDetail::where(['student_id' => $id, 'level_status' => 'Completed'])->count('*');

            $courseTopics = CourseTopic::where('course_id', $result[0]->course_id)->select('topics')->get();

	    $totalLevels = Level::select('*')->count();

         //   $pendingLevels = (int)$totalLevels - (int)$completedLevel;
            $pendingLevels = (int)$totalLevels - $result[0]->level_id;

	 
            $level = StudentDetail::leftjoin('levels', 'student_details.level_id', '=', 'levels.id')
                ->leftjoin('difficulty_levels', 'student_details.difficulty_level', '=', 'difficulty_levels.id')
                ->where('student_details.student_id', $id)
                ->select('levels.id', 'levels.level_name', 'student_details.level_status', 'difficulty_levels.id as difficulty_id', 'difficulty_levels.level_name as difficulty_level')
                ->get();

       //     $result[0]['tasks_completed'] = $tasksCompleted;
	    $result[0]['tasks_completed'] = $result[0]->level_id;
            $result[0]['level_completed'] = $completedLevel;
            $result[0]['course_topics'] = $courseTopics;
  	    $result[0]['pending_levels']= $pendingLevels;

            $levelCount = Level::select('id')->count('*');
            $progress = StudentDetail::leftjoin('levels', 'levels.id', '=', 'student_details.level_id')
                ->select('student_details.level_id', 'levels.level_name')
                ->where('student_id', $id)
                ->first();
            $result[0]['total_levels'] = $levelCount;
            $result[0]['progress'] = $progress;

            if ($level == true) {

                $tasklist = [];

                for ($i = 0; $i < count($level); $i++) {
                    $tasks = StudentTask::leftJoin('levels', 'student_tasks.level_id', '=', 'levels.id')
                        ->leftJoin('tasks', 'student_tasks.task_id', '=', 'tasks.task_id')

                        ->where(['student_tasks.level_id' => $level[$i]['id'], 'student_tasks.student_id' => $id])
                        ->get()
                        ->groupBy('level_name');

                    foreach ($tasks as $levelName => $tasksForLevel) {
                        $taskDetails = [];

                        foreach ($tasksForLevel as $task) {
                            $taskDetails[] = [
                                'taskId' => $task->task_id,
                                'taskName' => $task->task_name,
                            ];
                        }

                        $tasklist[] = [
                            'levelName' => $levelName,

                            'tasks' => $taskDetails,
                        ];
                    }
                    $result[$i]['taskList'] = $tasklist;
                }


                if ($result == true) {

                    return response()->json(['status' => true, 'message' => "Data retreived", 'data' => $result]);
                } else {
                    return response()->json(['status' => false, 'message' => "Failed to retreive data"]);
                }
            } else {
                return response()->json(['status' => false, 'message' => "Invalid token"]);
            }
        }
    }
    //Get student details by id for admin panel
    public function getStudentDetailAdminById(Request $request, $id)
    {

        if(Student::where('id', $id)->exists()){
            $result = Student::leftjoin('student_profiles', 'students.id', '=', 'student_profiles.student_id')
                            ->leftjoin('student_details', 'student_profiles.student_id', '=', 'student_details.student_id')
                            ->leftjoin('levels', 'student_details.level_id', '=', 'levels.id')
                            ->leftjoin('difficulty_levels', 'student_details.difficulty_level', '=', 'difficulty_levels.id')
                            ->leftjoin('student_tasks','student_tasks.student_id','=','students.id')
                            ->leftjoin('users', 'users.id', '=','students.instructor_id')
                            ->where('students.id', $id)
                            ->orderby('students.id', 'asc')
                            ->get(['students.*', 'student_profiles.*', 'student_details.*','student_tasks.is_completed as student_status', 
                            'levels.level_name', 'difficulty_levels.level_name as difficulty', 'users.first_name as instructor_first_name', 'users.last_name as instructor_last_name']);
            if ($result != null) {
                return view('student_view', ['data' => array($result)]);
                return response()->json(['status' => true, 'message' => "Data retreived", 'data' => $result]);
            } else {
                return response()->json(['status' => false, 'message' => "Failed to retreive"]);
            }
        } else {
            return response()->json(['status'=>false, 'message'=>"Student doesnt exists"], 400);
        }
       
    }

    public function studentEdit($id){
      
        if(Student::where('id', $id)->exists()){
            $result = Student::leftjoin('student_profiles', 'students.id', '=', 'student_profiles.student_id')
                            ->leftjoin('student_details', 'student_profiles.student_id', '=', 'student_details.student_id')
                            ->leftjoin('levels', 'student_details.level_id', '=', 'levels.id')
                            ->leftjoin('difficulty_levels', 'student_details.difficulty_level', '=', 'difficulty_levels.id')
                            ->leftjoin('student_tasks','student_tasks.student_id','=','students.id')
                            ->leftjoin('users', 'users.id', '=','students.instructor_id')
                            ->leftjoin('student_categories', 'students.student_category','=','student_categories.id')
                            ->where('students.id', $id)
                            ->orderby('students.id', 'asc')
                            ->get(['students.id as intern_id','students.*', 'student_profiles.*', 'student_details.*','student_tasks.is_completed as student_status', 
                            'levels.level_name', 'difficulty_levels.level_name as difficulty', 'users.first_name as instructor_first_name', 'users.last_name as instructor_last_name', 'student_categories.category_name as student_category', 'student_categories.id as student_category_id']);
            $instructors = User::select('id','first_name as instructor_first_name', 'last_name as instructor_last_name')->where(['is_active' => 1, 'role' => 2])->get();
            $category = StudentCategory::select('id as category_id','category_name')->where('is_active', 1)->get();
          
            if ($result != null) {
                return view('student_edit', ['data' => array($result), 'instructors' => $instructors, 'category' => $category]);
                return response()->json(['status' => true, 'message' => "Data retreived", 'data' => $result]);
            } else {
                return response()->json(['status' => false, 'message' => "Failed to retreive"]);
            }
        } else {
            return response()->json(['status'=>false, 'message'=>"Student doesnt exists"], 400);
        }
    }

    public function getStudentStatusById(Request $request, $id)
    {
       
        $result = Student::leftjoin('student_details', 'students.id', '=', 'student_details.student_id')
            ->leftjoin('levels', 'student_details.level_id', '=', 'levels.id')
            ->leftjoin('difficulty_levels', 'student_details.difficulty_level', '=', 'difficulty_levels.id')
            ->leftjoin('student_tasks', 'students.id', '=', 'student_tasks.student_id')
            ->leftjoin('tasks', 'student_tasks.task_id', '=', 'tasks.task_id')
            ->where(['students.id'=> $id, 'tasks.is_active' =>1])
            ->orderBy('student_tasks.start_date', 'desc')
            ->select('students.*', 'student_details.*', 'levels.*', 'difficulty_levels.level_name as difficulty', 'tasks.task_name')
           // ->get(['students.*', 'student_details.*', 'levels.*', 'difficulty_levels.level_name as difficulty', 'tasks.task_name']);
           ->get();

        $completedTasksCount = $result->where('is_completed', 1)->count(); // Count of completed tasks (is_completed = 1)

        if($completedTasksCount > 0){

        	if ($result != null) {
            		return view('student_status', [
                		'data' => array($result),
                		'completedTasksCount' => $completedTasksCount,
            		]);
            		// return response()->json(['status'=>true, 'message'=>'Data Retrieved','data'=>$result]);
        	} else {
            		return response()->json(['status' => false, 'message' => 'Failed to Retrieved']);
        	}
	    } else {
		return redirect()->route('students')->with('message','The intern hasnt finished the task');	
	}


    }

    public function datefilter(Request $request)
    {
        $result = student::orderBy('id', 'desc')
            ->when(
                $request->date_from && $request->date_to,
                function ($query) use ($request) {
                    $query->whereBetween(DB::raw('DATE(created_at)'), [
                        $request->date_from,
                        $request->date_to
                    ]);
                }
            )->paginate(5);

        return view('student_list', ['data' => array($result)]);
    }


 // Pending levels details
 public function getPendingLevelsDetails($student_id) {

    if(Student::where('id', $student_id)->exists()){
        $levels = Level::all();

        // Initialize an empty array to store the formatted results
        $formattedResults = [];
        
        // Iterate through each level
        foreach ($levels as $level) {
            // Get difficulty levels for this level
            $difficultyLevels = DifficultyLevel::select('id', 'level_name', 'no_of_questions')->get();
        
            // Initialize an array to store difficulty levels for this level
            $levelData = [];
        
            // Iterate through each difficulty level
            foreach ($difficultyLevels as $difficultyLevel) {
                // Get the number of questions attempted and pending for this difficulty level
                $totalQuestions = $difficultyLevel->no_of_questions;
        
                // Get the number of questions attempted by the student for this difficulty level
                $attemptedQuestions = StudentTask::where('student_id', $student_id)
                    ->where('level_id', $level->id)
                    ->where('difficulty_id', $difficultyLevel->id)
                    // ->where('is_completed', 'completed')
                    ->count();
        
                // Calculate the number of pending questions
                $pendingQuestions = $totalQuestions - $attemptedQuestions;
        
                // Add difficulty level data to the array
                $levelData[] = [
                    'difficulty' => $difficultyLevel->level_name,
                    'total_questions' => $totalQuestions,
                    'attempted_questions' => $attemptedQuestions,
                    'pending_questions' => $pendingQuestions,
                ];
            }
        
            // Add level data to the formatted results array
            $formattedResults[$level->level_name] = $levelData;
        }
        if($formattedResults != null){
            return response()->json(['status'=>true, 'message'=>"Data retreived", 'data'=>$formattedResults]);
        } else {
            return response()->json(['status'=>false, 'message'=>"Failed to retreive data", 'data'=>$formattedResults]);
        }
    } else {
        return response()->json(['status'=>false, 'message'=> "No such student exists"]);
    }
 }

 // assign category to interns
 public function AssignStudentCategory(Request $request, $intern_id){

    $category_id = $request->category_id;
   
    $result = Student::where('id', $intern_id)->update(['student_category' => $category_id]);

    if($result){
        return response()->json(['status'=>true, 'message'=>"Category assigned successfully"], 200);
    } else {
        return response()->json(['status'=>false, 'message'=>"Failed to assign category"], 400);
    }
 }


	//Forgot password
 public function resetPassword(Request $request){

    $validator = Validator::make($request->all(), [
        'email' => 'required|email', // Ensure 'email' is present and is a valid email format
        'new_password' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'message' => "Please enter email and new password",
                    ], 422);
    }

    $email = $request->email;

    if (!Student::where('email_id', $email)->exists()) {
        return response()->json(['status' => false, 'message' => "No such user"], 404);
    }

    // Additional email validation (optional)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return response()->json(['status' => false, 'message' => 'Email is not valid'], 422);
    }

    list($user, $domain) = explode('@', $email);
    if (!checkdnsrr($domain, 'MX')) {
        return response()->json(['status' => false, 'message' => 'Invalid email domain'], 422);
    }

    $new_password = Hash::make($request->new_password);

    $result = Student::where('email_id', $email)->update([
        'password' => $new_password
    ]);

    if ($result) {
        return response()->json(['status' => true, 'message' => "Password reset successfully"], 200);
    } else {
        return response()->json(['status' => false, 'message' => "Failed to reset password"], 500);
    }
 }

	//Interns view in cv
    public function getInternsResume(Request $request, $intern_id){

     if(Student::where('id', $intern_id)->exists()){
    	$user_access_token  = $request->token;
    	$TokenCheck = Student::where('id', $intern_id)->first();
    	$DB_token = json_decode($TokenCheck->remember_token, true);

    	if ($DB_token && is_array($DB_token) && in_array($user_access_token, $DB_token)) {
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
                        'students.phone',
                        'students.email_id',
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
                    ->first();

               if($task_performance != null){

                $no_of_tasks_completed = StudentTask::select('*')->where(['student_id'=> $intern_id, 'is_completed' => 1, 'level_id' => $task_performance['level_id'], 'difficulty_id'=>$task_performance['difficulty_level']])->count();

                $no_of_tasks_pending = StudentTask::select('*')->where(['student_id'=> $intern_id, 'is_completed' => 0,'level_id' => $task_performance['level_id'], 'difficulty_id'=>$task_performance['difficulty_level']])->count();
                
                $result['level'] = $task_performance->level;
                $result['no_of_tasks_completed'] = $no_of_tasks_completed;
                $result['no_of_tasks_pending'] = $no_of_tasks_pending;
             } else {
		$result['level'] = 0;
                $result['no_of_tasks_completed'] = 0 ;
                $result['no_of_tasks_pending'] = 0 ;
            }

            if($result) {
            	if($result->profile_pic != null){
                	$student_profile = $this->downloadImage($result->id);

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


//Intern info for admin
//Get student details by id for admin panel
    public function getInternInfoAdminById(Request $request, $intern_id, $employer_id)
    {

        if(Student::where('id', $intern_id)->exists()){
            $result = Student::leftjoin('student_profiles', 'students.id', '=', 'student_profiles.student_id')
                            ->leftjoin('student_details', 'student_profiles.student_id', '=', 'student_details.student_id')
                            ->leftjoin('levels', 'student_details.level_id', '=', 'levels.id')
                            ->leftjoin('difficulty_levels', 'student_details.difficulty_level', '=', 'difficulty_levels.id')
                            ->leftjoin('student_tasks','student_tasks.student_id','=','students.id')
                            ->leftjoin('users', 'users.id', '=','students.instructor_id')
                            ->where('students.id', $intern_id)
                            ->orderby('students.id', 'asc')
                            ->select(['students.id','students.first_name','students.last_name','students.email_id','students.phone','students.address1','students.address2','students.city',
                                      'students.district','students.state','students.country','students.pincode', 'student_profiles.highest_qualification', 'student_details.level_id', 'student_details.mode',
                                      'student_details.difficulty_level','student_tasks.is_completed as student_status', 'levels.level_name', 'difficulty_levels.level_name as difficulty', 
                                        'users.first_name as instructor_first_name', 'users.last_name as instructor_last_name'])
			    ->first();

           $approval = RequestForInternContact::select('is_admin_approved')->where(['intern_id'=>$intern_id, 'employer_id'=>$employer_id])->first();
	   if($approval != null) {
             $result['approval'] = $approval->is_admin_approved;
           } else {
             $result['approval'] = null;
           }
           $result['employer_id'] = $employer_id;

	    if ($result != null) {
                return view('intern_info', ['data' => array($result)]);
                return response()->json(['status' => true, 'message' => "Data retreived", 'data' => $result]);
            } else {
                return response()->json(['status' => false, 'message' => "Failed to retreive"]);
            }
        } else {
            return response()->json(['status'=>false, 'message'=>"Student doesnt exists"], 400);
        }
       
    }

}