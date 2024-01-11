<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    public function addNewCourseToDB(Request $request) { //databasedeki course table ına yeni eleman ekler.
        if ($request->isMethod('post')) {
            if (session()->has('login_control')) {
                if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                    $course = new Course();    
                    $course->course_name = $request->course_name;
                    $course->save();
                    return redirect()->route('get-our-course-page');
                }
                else {
                    return  view("index"); // giriş yapılmadıysa login ekranına yollanır
                }
            }
            return  view("index"); // Daha önce hiç login yapılmamışsa tarayıcı açıldığından beri direkt login sayfasına yönlendir
        }
        else{
            return redirect()->route('get-our-course-page');
        }
    }

    public function readCoursesFromDB(){
        if (session()->has('login_control')) {
            if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                $data["courses"] = Course::getAllCourses();
                return view("courses", compact("data")); // !!!buraya yazılmış olan blade in adı girilecek şuan öylesine koydum
            } else {
                return  view("index"); // giriş yapılmadıysa login ekranına yollanır
            }
        }
        return  view("index"); // Daha önce hiç login yapılmamışsa tarayıcı açıldığından beri direkt login sayfasına yönlendir
    }

    public function InformationsToOpenUpdatePage($courseId){
        if (session()->has('login_control')) {
            if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                $data["course"] = Course::getCourseInId($courseId);
                $data["teachers"] = Teacher::getTeacherInCourse($courseId);
                return view("courseEdit", compact("data")); // !!!buraya yazılmış olan blade in adı girilecek şuan öylesine koydum
            } else {
                return  view("index"); // giriş yapılmadıysa login ekranına yollanır
            }
        }
        return  view("index");
    }

    public function updateCourse(Request $request){
        if ($request->isMethod('post')) {
            if (session()->has('login_control')) {
                if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                    $course = Course::getCourseInId($request->course_id);
                    $course->course_name = $request->course_name;
                    $course->save();
                    return redirect()->route('get-update-course-page', ['courseId' => $request->course_id]);
                }
                else {
                        return  view("index"); // giriş yapılmadıysa login ekranına yollanır
                }
            }
            return  view("index"); // Daha önce hiç login yapılmamışsa tarayıcı açıldığından beri direkt login sayfasına yönlendir
        }
        else{
            return redirect()->route('get-our-course-page');
        }
    }

    public function deleteCourse($courseId){
        if (session()->has('login_control')) {
            if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                Course::deleteCourseInId($courseId);
                Teacher::doNullCourseColumnInId($courseId);
                $data["courses"] = Course::getAllCourses();
                return view("courses", compact("data")); // !!!buraya yazılmış olan blade in adı girilecek şuan öylesine koydum
            }
            else {
                return  view("index"); // giriş yapılmadıysa login ekranına yollanır
            }
        }
        return  view("index"); // Daha önce hiç login yapılmamışsa tarayıcı açıldığından beri direkt login sayfasına yönlendir
    }

}