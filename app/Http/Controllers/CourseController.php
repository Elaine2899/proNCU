<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    //
}
