<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\StudentProfile;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

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

    // Student update profile
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
        $user = User::insert([
               'first_name' => $request->first_name,
               'last_name' => $request->last_name,
               'email' => $request->email,
               'phone' => $request->phone,
               'password' => $password,
               'is_student' => 1,
               'created_at' => date('Y-m-d')
        ]); // eloquent creation of data

        $success['user'] = $user;

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

        try {
            // this authenticates the user details with the database and generates a token
            if (! $token = JWTAuth::attempt($input)) {
                return $this->sendError([], "invalid login credentials", 400);
            }
        } catch (JWTException $e) {
            return $this->sendError([], $e->getMessage(), 500);
        }
        
        User::where('email', $request->email)->update(['remember_token' => $token]);
        $result = User::where('email', $request->email)->get();
        
        $success = [
            'token' => $token,
            'email' => $request->email,
            'name' => $result[0]->first_name,
            'id' => $result[0]->id
        ];
        return $this->sendResponse($success, 'successful login', 200);
    }

    //Update Student profile
    public function updateStudentProfile(Request $request, $id){

        if(User::where('id', $id)->exists()){
            $user_access_token  = $request->token;
            $TokenCheck = User::where('id', $id)->first();
            $DB_token = $TokenCheck->remember_token;
            if($DB_token == $user_access_token){
                $student_id = $id;
                $mode = $request->user_mode;
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
    public function applyCourse(Request $request, $user_id){

        if(User::where('id', $user_id)->exists()){
            $course_id = $request->course_id;

            $result = StudentProfile::where('student_id', $user_id)->update([
                      'course_id' => $course_id
            ]);

            if($result = true){
                return response()->json(['status'=> true, 'message' => "Updated course id"]);
            } else {
                return response()->json(['status'=> false, 'message' => "Failed to update"]);
            }
        } else {
            return response()->json(['status'=> false, 'message' => "No such student found"]);
        }
    }

    //Get students details
    public function getStudentDetails() {
        
        $result = User::leftjoin('student_profiles','users.id', '=','student_profiles.student_id')
                        ->leftjoin('courses','student_profiles.course_id','=','courses.id')
                        ->where('users.is_student', '1')
                        ->orderby('tasks.created_at', 'asc')
                        ->paginate(10)
                        ->get(['users.*','student_profiles.*','courses.course_name']);
        
        if(!empty($result)){
            return view('student_list', ['data' => array($result)]);
            return response()->json(['status'=>true, 'message'=>"Data retreived", 'data'=>$result]);
        } else {
            return response()->json(['status'=>false, 'message'=>"Failed to retreive"]);
        }
        
    }

    //Get student details by id
    public function getStudentDetailById($id) {

        $result = User::leftjoin('student_profiles', 'users.id', '=', 'student_profiles.student_id')
                        ->leftjoin('courses', 'student_profiles.course_id', '=', 'courses.id')
                        ->where('users.id', $id)
                        ->get(['users.*', 'student_profiles.*']);
        
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
        
        $result = User::leftjoin('student_profiles', 'users.id' , '=', 'student_profiles.student_id')
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
   
    if(User::where('id', $id)->exists()){
       
        $user_access_token  = $request->token;
        $TokenCheck = User::where('id', $id)->first();
        $DB_token = $TokenCheck->remember_token;
        if($DB_token == $user_access_token){
         $result = User::select('*')->where('id', $id)->first();
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
   
    if(User::where('id', $id)->exists()){
       
        $user_access_token  = $request->token;
        $TokenCheck = User::where('id', $id)->first();
        $DB_token = $TokenCheck->remember_token;
        if($DB_token == $user_access_token){
         $result = studentProfile::select('*')->where('student_id', $id)->first();
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
  
}