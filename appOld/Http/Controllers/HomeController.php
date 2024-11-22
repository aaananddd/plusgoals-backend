<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Student;
use App\Models\Task;
use App\Models\StudentProfile;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $this->user = Auth::user();

            return $next($request);
        });
     //   $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
   
        $user = Session::get('user');  
        $user_id = $user->id;
        $response = User::select('*')->where('id', $user_id)->get();
        $teachers = User::where('role', '2')->count();
        $students = Student::where('is_active', '1')->count();
        $courses = Course::all()->count();
        $approved_tasks = Task::select('*')->where(['is_active' => 1, 'is_admin_approved' => 1])->count();
        $pending_tasks = Task::select('*')->where(['is_active' => 1, 'is_admin_approved' => 0])->count();

        return view('dashboard', ['data' => array($response), 'teachers'=>$teachers, 'students'=>$students, 'courses'=>$courses,'approved_tasks'=>$approved_tasks, 'pending_approval' => $pending_tasks]);
    }
    public function login()
    {
       
        return view('login');
    }

    public function resetPassword()
    {
        return view('password');
    }

    //dashboard
    public function dashboard(){
     
        $teachers = User::where(['role'=> '2', 'is_active' => 1])->count();
        $students = User::where('is_student', '1')->count();
        $courses = Course::all()->count();
        $tasks = Task::all()->where(['is_active' => 1, 'is_admin_approved' => 1])->count();
        return view('dashboard', ['teachers'=>$teachers, 'students'=>$students, 'courses'=>$courses,'tasks'=>$tasks]);
        return response()->json(['status' => true, 'data' => array('teachers' => $teachers, 'students' => $students, 'courses' => $courses, 'tasks' => $tasks)]);
    }
    
    public function logout(Request $request){
     
    $user = Session::get('user'); 
    if(User::where('id', $user->id)->exists()){
        $user_access_token = $user->remember_token;
        $result = User::where('id', $user->id)->update([
                'remember_token' => null,
        ]);
        if($result){
                       return view('login');
                return response()->json(['status' => true, 'message' => "Logged out"], 200);
         } else {
                return response()->json(['status' => false, 'message' => "Failed to logout"], 401);
        }
    } else {
        return response()->json(['status' => false, 'message' => "User not found"], 404);
    }
    }

}
