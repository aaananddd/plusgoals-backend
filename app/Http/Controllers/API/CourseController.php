<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    // Add courses
    public function AddCourse(Request $request){
        
        $course_name = $request->course_name;
        $course_desc = $request->course_desc;
        $mode = $request->mode;

        $result = Course::insert([
            'course_name'=>$course_name,
            'course_desc'=>$course_desc,
            'mode'=>$mode,
            'created_at'=>date('Y-m-d h:m:s')
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
}
