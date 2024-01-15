<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\TeacherClassroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class ClassroomController extends Controller
{
    // Sınıfın harfi küçükse büyültülüp database o şekilde yazılmalı.
    public function addNewClassroomToDB(Request $request) { //databasedeki classroom table ına yeni eleman ekler.
        if ($request->isMethod('post')) {
            if (session()->has('login_control')) {
                if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                    $classroom = new Classroom();   
                    $classroom->classroom_name = $request->classroom_name;
                    $classroom->save();
                    return redirect()->route('get-our-classroom-page');
                }
                else {
                    return  view("index"); // giriş yapılmadıysa login ekranına yollanır
                }
            }
            return  view("index"); // Daha önce hiç login yapılmamışsa tarayıcı açıldığından beri direkt login sayfasına yönlendir
        }
        else{
            return redirect()->route('get-our-classroom-page');
        }
    }

    public function readClassroomsFromDB(){
        if (session()->has('login_control')) {
            if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                $data["classrooms"] = Classroom::getAllClassrooms();
                return view("classes", compact("data")); // !!!buraya yazılmış olan blade in adı girilecek şuan öylesine koydum
            } else {
                return  view("index"); // giriş yapılmadıysa login ekranına yollanır
            }
        }
        return  view("index"); // Daha önce hiç login yapılmamışsa tarayıcı açıldığından beri direkt login sayfasına yönlendir
    }

    public function InformationsToOpenUpdatePage($classroomId){
        if (session()->has('login_control')) {
            if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                $data["classroom"] = Classroom::getClassroomInId($classroomId);
                $data["students"] = Student::getStudentInClassroomId($classroomId);
                if (isset($data["students"])){
                    if (is_iterable($data["students"])){
                        foreach($data["students"] as $student){
                            $imagePath = $student->student_image;
                            if ($imagePath){
                                $student->student_image = base64_encode(File::get(storage_path("app/public/{$imagePath}")));
                            } 
                        }
                    } else {
                        $imagePath = $data["students"][0]->student_image;
                        if ($imagePath){
                            $data["students"][0]->student_image = base64_encode(File::get(storage_path("app/public/{$imagePath}")));
                        } 
                    }
                }
                return view("classEdit", compact("data")); // !!!buraya yazılmış olan blade in adı girilecek şuan öylesine koydum
            } else {
                return  view("index"); // giriş yapılmadıysa login ekranına yollanır
            }
        }
        return  view("index");
    }
    
    public function updateClassroom(Request $request){
        if ($request->isMethod('post')) {
            if (session()->has('login_control')) {
                if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                    $classroom = Classroom::getClassroomInId($request->classroom_id);
                    $classroom->classroom_name = $request->classroom_name;
                    $classroom->save();
                    return redirect()->route('get-update-classroom-page', ['classroomId' => $request->classroom_id]);
                }
                else {
                    return  view("index"); // giriş yapılmadıysa login ekranına yollanır
                }
            }
            return  view("index"); // Daha önce hiç login yapılmamışsa tarayıcı açıldığından beri direkt login sayfasına yönlendir
        }
        else{
            return redirect()->route('get-our-classroom-page');
        }
    }

    public function deleteClassroom($classroomId){
        if (session()->has('login_control')) {
            if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                Classroom::deleteClassroomInId($classroomId);
                Student::doNullClassroomColumnInId($classroomId);
                TeacherClassroom::deleteRowsByClassroomId($classroomId);
                return redirect()->route('get-our-classroom-page');
            }
            else {
                return  view("index"); // giriş yapılmadıysa login ekranına yollanır
            }
        }
        return  view("index"); // Daha önce hiç login yapılmamışsa tarayıcı açıldığından beri direkt login sayfasına yönlendir
    }
}
