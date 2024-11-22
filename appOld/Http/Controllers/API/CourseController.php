<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseTopic;

class CourseController extends Controller
{
    // Add courses
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
        
            if($result == TRUE) {
                return response()->json(['status'=>true, 'data'=>$result]);
        } else {
            return response()->json(['status'=>false,'message'=>'Failed to add']);
        }
    }

    // Get courses details
    public function GetCourse(){

        $result = Course::select('*')->get();
        
        if($result != null){
            return response()->json(['status'=>true, 'data'=>$result]);
        } else {
            return response()->json(['status'=>false]);
        }
    }

    //Get courses by id
    public function getCoursesById($id){
        $courses = Course::where('id', $id)->first();

        if($courses != null){
            return response()->json(['status'=>true, 'data'=>$courses]);
        } else {
            return resposne()->json(['status'=>false]);
        }
    }

    //Update Course by id
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

            if($result == true){
                return response()->json(['status'=>true, 'message'=>"Updated course details"]);
            } else {
                return response()->json(['status'=>false, 'message'=>"Failed to update"]);
            }
        } else {
            return response()->json(['status'=>true, 'message'=>"No such course exists"]);
        }
    }
    
    
 //Add topics into course_topics table
    public function addTopicIntoCourse(Request $request) {
        $course_id = $request->course_id;
        $topic = $request->topics;

        $result = CourseTopic::insert([
            "course_id"=>$course_id,
            "topics"=>$topic,
            "created_at"=>date('Y-m-d')
        ]);

        if($result == true){
            return response()->json(['status'=>true, 'message'=>"Successfully added topics"]);
        } else {
            return response()->json(['status'=>false, 'message'=>"Failed to add"]);
        }
    }
}
