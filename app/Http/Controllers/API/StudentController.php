<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\StudentProfile;
use App\Models\StudentDetail;
use App\Models\Course;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Laravel\Sanctum\HasApiTokens;

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
            'email' => 'required|email|unique:users',
            'phone' => 'required|min:10|max:12',
            'password' => 'required|min:6',
            'c_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return $this->sendError($validator->errors(), 'Validation Error', 422);
        }
       
        $password = bcrypt($request->password); // use bcrypt to hash the passwords
  
        $user = Student::insert([
               'first_name' => $request->first_name,
               'last_name' => $request->last_name,
               'email_id' => $request->email,
               'phone' => $request->phone,
               'password' => $password,
               'is_active' => 1,
               'created_at' => date('Y-m-d')
        ]); // eloquent creation of data

        $success['student'] = $user;

        return $this->sendResponse($success, 'Student registered successfully', 201);

    }

    // Student login
    public function login(Request $request)
    {
        $input = $request->only('email', 'password');

        $validator = Validator::make($input, [
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors(), 'Validation Error', 422);
        }

        // try {
        //     // this authenticates the user details with the database and generates a token
        //     if (! $token = JWTAuth::attempt($input)) {
        //         return $this->sendError([], "invalid login credentials", 400);
        //     }
        // } catch (JWTException $e) {
        //     return $this->sendError([], $e->getMessage(), 500);
        // }
       // $token = createToken($input)->plainTextToken;
        $token = md5(uniqid(). rand(1000000, 9999999));
        Student::where('email_id', $request->email)->update(['remember_token' => $token]);
        $result = Student::where('email_id', $request->email)->get();
        
        $success = [
            'token' => $token,
            'email_id' => $request->email,
            'name' => $result[0]->first_name,
            'id' => $result[0]->id
        ];
        return $this->sendResponse($success, 'successful login', 200);
    }

  // Update User details
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
     if(Student::where('id', $id)->exists()){
      $user_access_token  = $request->token;
      $TokenCheck = Student::where('id', $id)->first();
      $DB_token = $TokenCheck->remember_token;
      if($DB_token == $user_access_token){
          $UserCheck = Student::select('*')->where('id', $id)->first();

          if($UserCheck != null) {
              $first_name = $request->first_name ? $request->first_name:$UserCheck[0]->first_name;
              $last_name = $request->last_name  ? $request->last_name:$UserCheck[0]->last_name;
              $address1 = $request->address1  ? $request->address1:$UserCheck[0]->address1;
              $address2 = $request->address2  ? $request->address2:$UserCheck[0]->address2;
              $city = $request->city  ? $request->city:$UserCheck[0]->city;
              $district = $request->district ? $request->district:$UserCheck[0]->district;
              $state = $request->state ? $request->state:$UserCheck[0]->state;
              $country = $request->country ? $request->country:$UserCheck[0]->country;
              $phone = $request->phone ? $request->phone:$UserCheck[0]->phone;
              $pincode = $request->pincode ? $request->pincode:$UserCheck[0]->phone;
              
              
              $UpdateProfile = Student::where('id', $id)->first();
              $update = Student::where('id', $id)->update([
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
                          'is_active' => '1'
                  ]);
                  
            if($update == true){
                      return response()->json(['status' => true, 'message'=> "Updated user details successfully"]);
            } else {
                return response()->json(['status' => true, 'message'=> "Failed to update"]);
            }
           }  else {
                return response()->json(['status' => false, 'message' => "No such user exists"]);
            }
      } else {
          return response()->json(['status'=>false,'message'=>'Invalid token']);
      }
     
      } else {
          return response()->json(['status'=>false, 'message'=>"No such user"]);
      }
  } 

   //Insert Student educational details
   public function insertStudentProfile(Request $request, $id){

    if(Student::where('id', $id)->exists()){
        $user_access_token  = $request->token;
        $TokenCheck = Student::where('id', $id)->first();
        $DB_token = $TokenCheck->remember_token;
        if($DB_token == $user_access_token){
            $student_id = $id;
            $mode = $request->mode;
            $highest_qualification = $request->highest_qualification;
            $institute = $request->institute;
            $board = $request->board;
            $total_marks = $request->total_marks;

        $result = StudentProfile::insert([
            'student_id' => $student_id,
            'mode' => $mode,
            'highest_qualification' => $highest_qualification,
            'institute' => $institute,
            'board' => $board,
            'total_marks' => $total_marks,
            'created_at' => date('Y-m-d')
    ]);

    if($result = true){
        return response()->json(["status" => true, "message" =>"Record inserted successfully"]);
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

//Update Student educational details
public function updateStudentProfile(Request $request, $id){

    if(Student::where('id', $id)->exists()){
        $user_access_token  = $request->token;
        $TokenCheck = Student::where('id', $id)->first();
        $DB_token = $TokenCheck->remember_token;
        if($DB_token == $user_access_token){
            $student_id = $id;
            $mode = $request->mode;
            $highest_qualification = $request->highest_qualification;
            $institute = $request->institute;
            $board = $request->board;
            $total_marks = $request->total_marks;

        $result = StudentProfile::where('student_id',$student_id)->update([
            'mode' => $mode,
            'highest_qualification' => $highest_qualification,
            'institute' => $institute,
            'board' => $board,
            'total_marks' => $total_marks,
            'created_at' => date('Y-m-d')
    ]);

    if($result = true){
        return response()->json(["status" => true, "message" =>"Record updated successfully"]);
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
    public function applyCourse(Request $request, $id){

        if(Student::where('id', $id)->exists()){
            $course_id = $request->course_id;
            $courseDetails = Course::select('*')->where('id', $course_id)->get();
            $mode = $courseDetails[0]->mode;
            
            $result = StudentDetail::insert([
                    'student_id' => $id,
                    'course_id' => $course_id,
                    'level_id' => '1',
                    'mode' => $mode,
                    'difficulty_level' => '1',
                    'level_status' => "start",
                    'created_at' => date('Y-m-d'),
                    
            ]);

            if($result = true){
                return response()->json(['status'=> true, 'message' => "Applied to course successfully"]);
            } else {
                return response()->json(['status'=> false, 'message' => "Failed to update"]);
            }
        } else {
            return response()->json(['status'=> false, 'message' => "No such student found"]);
        }
    }

    //Get students details
    public function getStudentDetails() {
        
        $result = StudentProfile::leftjoin('students', 'students.id', '=', 'student_profiles.student_id')
                                ->leftjoin('student_details','student_profiles.student_id','=','student_details.student_id')
                                ->leftjoin('courses','student_details.course_id','=','courses.id')
                                ->where('students.is_active', '1')
                                ->orderby('students.id', 'asc')
                                ->paginate(10);
       
                       // ->get(['students.*', 'student_profiles.*','student_details.*','courses.course_name']);
                    
        if(!empty($result)){
            return view('student_list', ['data' => array($result)]);
            return response()->json(['status'=>true, 'message'=>"Data retreived", 'data'=>$result]);
        } else {
            return response()->json(['status'=>false, 'message'=>"Failed to retreive"]);
        }
        
    }

    //Get student details by id
    public function getStudentDetailById($id) {

        $result = Student::leftjoin('student_profiles','students.id', '=','student_profiles.student_id')
                         ->leftjoin('student_details','student_profiles.student_id','=','student_details.student_id')
                         ->leftjoin('courses','student_details.course_id','=','courses.id')
                         ->where('students.id', $id)
                         ->orderby('students.id', 'asc')
       // ->paginate(10)
                        ->get(['students.*', 'student_profiles.*','student_details.*','courses.course_name']);
        if($result != null){
            return response()->json(['status'=>true, 'message'=>"Data retreived", 'data'=>$result]);
        } else {
            return response()->json(['status'=>false, 'message'=>"Failed to retreive"]);
        }
    }

    //Get paid students details
    public function getPaidStudents() {
        
        $result = User::leftjoin('student_profiles', 'users.id' , '=', 'student_profiles.student_id')
                        ->leftjoin('courses', 'student_profiles.course_id', '=', 'courses.id')
                        ->where('users.is_student', '1')
                        ->where('student_profiles.mode', "Paid")
                        ->get(['users.*', 'student_profiles.*','courses.course_name']);
     
        if($result != null){
            return view('paid_Students', ['data' => array($result)]);
            return response()->json(['status'=>true, 'message'=>"Data retreived", 'data'=>$result]);
        } else {
            return response()->json(['status'=>false, 'message'=>"Failed to retreive"]);
        }
        
    }


    //Get unpaid students details
    public function getUnPaidStudents() {
        
        $result = Student::leftjoin('student_profiles', 'users.id' , '=', 'student_profiles.student_id')
                        ->leftjoin('courses', 'student_profiles.course_id', '=', 'courses.id')
                        ->where('users.is_student', '1')
                        ->where('student_profiles.mode', "Free")
                        ->get(['users.*','student_profiles.*', 'courses.course_name']);
        
        if($result != null){
            return view('unpaid_Students', ['data' => array($result)]);
            return response()->json(['status'=>true, 'message'=>"Data retreived", 'data'=>$result]);
        } else {
            return response()->json(['status'=>false, 'message'=>"Failed to retreive"]);
        }
   }

 //student profile details
 public function studentProfile(Request $request, $id){
   
    if(Student::where('id', $id)->exists()){
       
        $user_access_token  = $request->token;
        $TokenCheck = Student::where('id', $id)->first();
        $DB_token = $TokenCheck->remember_token;
        if($DB_token == $user_access_token){
         $result = Student::select('*')->where('id', $id)->first();
         if($result == true){
            return response()->json(['status' => true, 'message' => "Data retreived successfully", 'data' => $result]);
         }else {
            return response()->json(['status' => false, 'message' => "Failed to retreive data"]);
         }
       }else {
         return response()->json(['status'=>false,'message'=>'Invalid token']);
       }
    } else {
        return response()->json(['status'=>false, 'message'=>"No such user"]);
    }
 }

 //student educational details
 public function studentEducationalDetails(Request $request, $id){
   
    if(Student::where('id', $id)->exists()){
       
        $user_access_token  = $request->token;
        $TokenCheck = Student::where('id', $id)->first();
        $DB_token = $TokenCheck->remember_token;
        if($DB_token == $user_access_token){
         $result = StudentProfile::select('*')->where('student_id', $id)->first();
         if($result == true){
            return response()->json(['status' => true, 'message' => "Data retreived successfully", 'data' => $result]);
         }else {
            return response()->json(['status' => false, 'message' => "Failed to retreive data"]);
         }
       }else {
         return response()->json(['status'=>false,'message'=>'Invalid token']);
       }
    } else {
        return response()->json(['status'=>false, 'message'=>"No such user"]);
    }
 }

 //Update student details table
 public function updateStudentDetails(Request $request, $id)
 {
    if(Student::where('id', $id)->exists()){
       
        $user_access_token  = $request->token;
        $TokenCheck = Student::where('id', $id)->first();
        $DB_token = $TokenCheck->remember_token;
        if($DB_token == $user_access_token){
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

            if($result = true){
                return response()->json(['status'=> true, 'message' => "Updated successfully"]);
            } else {
                return response()->json(['status'=> false, 'message' => "Failed to update"]);
            }
        }else {
            return response()->json(['status'=>false,'message'=>'Invalid token']);
          }
       } else {
           return response()->json(['status'=>false, 'message'=>"No such user"]);
       }
  
    }

}