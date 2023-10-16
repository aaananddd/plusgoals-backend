<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
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
    public function index()
    {
       
        $user = Session::get('user'); 
        $id = $user->id;
        $response = User::select('*')->where('id', $id)->get();

        $teachers = User::where('role', '2')->count();
        $students = User::where('is_student', '1')->count();
        $courses = Course::all()->count();
        $tasks = Task::all()->count();

        return view('dashboard', ['data' => array($response), 'teachers'=>$teachers, 'students'=>$students, 'courses'=>$courses,'tasks'=>$tasks]);
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
     
        $teachers = User::where('role', '2')->count();
        $students = User::where('is_student', '1')->count();
        $courses = Course::all()->count();
        $tasks = Task::all()->count();

        return view('dashboard', ['teachers'=>$teachers, 'students'=>$students, 'courses'=>$courses,'tasks'=>$tasks]);
        return response()->json(['status' => true, 'data' => array('teachers' => $teachers, 'students' => $students, 'courses' => $courses, 'tasks' => $tasks)]);
    }
}
