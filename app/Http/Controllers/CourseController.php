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

    public function readCoursesFromDB(){
        if (session()->has('login_control')) {
            if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                $data["courses"] = Course::getAllCourses();
                dd($data);
                //return view("index", compact("data")); // !!!buraya yazılmış olan blade in adı girilecek şuan öylesine koydum
            } else {
                return  view("index"); // giriş yapılmadıysa login ekranına yollanır
            }
        }
        return  view("index"); // Daha önce hiç login yapılmamışsa tarayıcı açıldığından beri direkt login sayfasına yönlendir
    }

    public function updateCourse(Request $request){
        $course = Course::getCourseInId($request->course_id);
        $course->classroom_name = $request->course_name;
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