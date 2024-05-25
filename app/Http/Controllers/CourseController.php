<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CourseController extends Controller
{
    public function ShowCourseSearch(){
        return view(view:"course_search");
    }

    public function ShowCourseDashboard(){
        return view(view:"course_dashboard");
    }

    public function ShowCourseTable(){
        return view(view:"course_table");
    }

    public function getCourses(){

        $sid = Session::get('user_sid');
        $semester = "112-2";
        $query = "SELECT * FROM courses WHERE user_sid = ? AND semester = ?";
        $courses = DB::select($query, [$sid, $semester]);
        return response()->json($courses);

    }


    public function addCourse(Request $request)
    {
        $sid = session('user_sid');
        $course = new Course();
        $course->courseNo = $request->input('course_no');
        $course->semester = $request->input('course_semester');
        $course->user_sid = $sid;
        $course->save();

    }

    public function deleteCourse(Request $request)
    {
        try {
            $sid = Session::get('user_sid');
            if (!$sid) {
                return response()->json(['error' => 'User SID not found in session'], 400);
            }
    
            $deleted = Course::where('semester', $request->semester)
                            ->where('courseNo', $request->courseNo)
                            ->where('user_sid', $sid)
                            ->delete();
    
            if ($deleted) {
                return response()->json(['status' => 'Course deleted']);
            } else {
                return response()->json(['error' => 'Course not found or not authorized to delete'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    
    }


    //
}
