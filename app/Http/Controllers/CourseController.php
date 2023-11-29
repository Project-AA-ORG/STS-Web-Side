<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    public function addNewTeacherToDB(Request $request) { //databasedeki course table ına yeni eleman ekler.
        $course = new Course();    
        $course->course_name = $request->course_name;
        $course->save();
    }

    public function deneme($request) { //databasedeki course table ına yeni eleman ekler.
        $course = new Course();  
        $course->course_name = $request["course_name"];

        $course->save();
    }

    public function deneme2() { //databasedeki course table ına yeni eleman ekler.
        $data["course_name"] = "fen";

        CourseController::deneme($data);
    }

}