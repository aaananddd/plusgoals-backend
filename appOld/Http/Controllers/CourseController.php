<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Level;
use App\Models\CourseTopic;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $result = Course::leftjoin('levels','courses.level','=','levels.id')
                        ->select('courses.*', 'levels.level_name')
        // $courses = Course::select('*')->get();
                         ->orderby('courses.id', 'asc')
                        ->paginate(10);
      
        return view('course', ['data' => array($result)]);
    
    }

    public function getCoursesById($id){
       $courses = Course::leftjoin('levels','levels.id','=','courses.level')
                            ->select('*')->where('courses.id', $id)->first();
        $topics = CourseTopic::select('topics')->where('course_id',$id)->get();
        $topicCount = CourseTopic::where('course_id', $id)->count('*');

        $level = Course::leftjoin('levels','courses.level','=','levels.id')
                        ->select('courses.level')
                        ->where('courses.id', $id)
                        ->get();

        if($courses != null){
           
            return view('course_view', ['data' => array($courses),'topics' => $topics, 'topicCount' => $topicCount, 'level' => $level]);
            // return response()->json(['status'=>true, 'data'=>$courses]);
        } else {
            return response()->json(['status'=>false]);
        }
    }
    
    public function updateCoursebyId(Request $request, $id){

        if(Course::where('id', $id)->exists()){
            $courseDetails = Course::select('*')->where('id', $id)->get();
            $OldCoursename = $courseDetails[0]->course_name;
            $OldCoursedesc = $courseDetails[0]->course_desc;
            $OldCoursemode = $courseDetails[0]->mode;
            $OldCourselevel = $courseDetails[0]->level;

            $course_name = $request->course_name ? $request->course_name : $OldCoursename;
            $course_desc = $request->course_desc ? $request->course_desc : $OldCoursedesc;
            $mode = $request->mode ? $request->mode : $OldCoursemode;
            $level = $request->level ? $request->level : $OldCourselevel;

            $result = Course::where('id',$id)->update([
                'course_name' => $course_name,
                'course_desc' => $course_desc,
                'mode' => $mode,
                'level' => $level
            ]);

            // $updateCoursetopic = CourseTopic::where()
            
            $result = Course::leftjoin('levels','courses.level','=','levels.id')
            ->select('courses.*', 'levels.level_name')
// $courses = Course::select('*')->get();
             ->orderby('courses.id', 'asc')
            ->paginate(10);
            if($result == true){
                return view('course',['data'=>array($result)]);
                return response()->json(['status'=>true, 'message'=>"Updated course details"]);
            } else {
                return response()->json(['status'=>false, 'message'=>"Failed to update"]);
            }
        } else {
            return response()->json(['status'=>true, 'message'=>"No such course exists"]);
        }
    }

    public function CoursesById($id){
        $courses = Course::select('*')->where('id', $id)->first();
        $topics = CourseTopic::select('topics')->where('course_id',$id)->get();
        $levelResult = Level::select('*')->get();
        $topicCount = CourseTopic::where('course_id', $id)->count('*');
        // dd($levelResult);

        if($courses != null){
            return view('course_edit', ['data' => array($courses),'topics' => $topics, 'topicCount' => $topicCount,'level' => $levelResult]);
            // return response()->json(['status'=>true, 'data'=>$courses]);
        } else {
            return response()->json(['status'=>false]);
        }
    }

    public function AddCourse(Request $request){


        $course_name = $request->course_name;
        $course_desc = $request->course_desc;
        $mode = $request->mode;
        $level = $request->level;

        $result = Course::insert([
            'course_name'=>$course_name,
            'course_desc'=>$course_desc,
            'mode'=>$mode,
            'level' => $level,
            'created_at'=>date('Y-m-d')
            ]);
            // dd($result);
            if($result == TRUE) {
                $courses = Course::select('*')->get();
                return view('course', ['data' => array($courses)]);
                // return response()->json(['status'=>true, 'data'=>$result]);
        } else {
            return response()->json(['status'=>false,'message'=>'Failed to add']);
        }
    }

public function CourseLevels(){
          
        // $result = DifficultyLevel::select('*')->get();
        $result = Level::select('*')->get();
        // $course = Course::select('*')->get();
        
        if($result == true){
            return view('create_course', ['level' => array($result)]);
            // return view('assign_task', ['difficultylevel' => $result, 'level' => $levelResult, 'course' => $course]);
            // return response()->json(['status' => true, 'message' => "Data retreived", 'data' => $result]);
        } else {
            return response()->json(['status' => false, 'message' => "Failed to retreive data"]);
        }
    }
}
