<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\ParentStudent;
use App\Models\Student;
use App\Models\TeacherClassroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class StudentController extends Controller
{
    public function addNewStudentToDB(Request $request) { //databasedeki student table ına yeni eleman ekler.
        if ($request->isMethod('post')) {
            if (session()->has('login_control')) {
                if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                    $student = new Student();
                    $student->name = $request->name;    
                    $password = $request->username . "123"; // otomatik şifre ayarladım.
                    $student->password = $password;
                    $student->username = $request->username;
                    $student->classroom_id = $request->classroom_id;
                    $student->student_no = $request->student_no;

                    if (!(Student::searchUserName($request->username))) { // daha önce bu username kullanılmış mı kullanılmamış mı diye kontrol ettim.
                        $student->save();
                        return redirect()->route('get-our-student-page');
                    }
                    else{
                        $data["classrooms"] = Classroom::getAllClassrooms();
                        $data["students"] = Student::getAllStudents();
                        $data["error"] = "Bu username daha önce kullanıldı";
                        return view("students", compact("data")); // !!!buraya yazılmış olan blade in adı girilecek şuan öylesine koydum
                    }
                }
                else {
                    return  view("index"); // giriş yapılmadıysa login ekranına yollanır
                }
            }
            return  view("index"); // Daha önce hiç login yapılmamışsa tarayıcı açıldığından beri direkt login sayfasına yönlendir
        }
        else{
            return redirect()->route('get-our-student-page');
        }
    }

    //Öğretmenleri liste halinde blade e yollama fonksiyonu
    public function readStudentsFromDB(){
        if (session()->has('login_control')) {
            if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                $data["classrooms"] = Classroom::getAllClassrooms();
                $data["students"] = Student::getAllStudents();
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
                return view("students", compact("data")); // !!!buraya yazılmış olan blade in adı girilecek şuan öylesine koydum
            } else {
                return  view("index"); // giriş yapılmadıysa login ekranına yollanır
            }
        }
        return  view("index"); // Daha önce hiç login yapılmamışsa tarayıcı açıldığından beri direkt login sayfasına yönlendir
    }

    public function InformationsToOpenUpdatePage($studentId){
        if (session()->has('login_control')) {
            if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                $data["classrooms"] = Classroom::getAllClassrooms();
                $data["student"] = Student::getClassroomWithStudent($studentId);
                $imagePath = $data["student"]->student_image;
                if ($imagePath){
                    $data["student"]->student_image = base64_encode(File::get(storage_path("app/public/{$imagePath}")));
                } 
                return view("studentEdit", compact("data")); // !!!buraya yazılmış olan blade in adı girilecek şuan öylesine koydum
            } else {
                return  view("index"); // giriş yapılmadıysa login ekranına yollanır
            }
        }
        return  view("index");
    }

    public function updateStudent(Request $request){
        if ($request->isMethod('post')) {
            if (session()->has('login_control')) {
                if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                    $student = Student::getStudentInId($request->student_id);

                    if ($student->username != $request->username){ //Eğer güncelleme yaparken username değiştirilmişse
                        if (!(Student::searchUserName($request->username))) { // daha önce bu username kullanılmış mı kullanılmamış mı diye kontrol ettim.
                            $student->name = $request->name;
                            $student->username = $request->username;
                            $student->classroom_id = $request->classroom_id;
                            $student->student_no = $request->student_no;
                            if (isset($request->control)){
                                if ($request->control){
                                    $student->student_image = null;
                                }
                            }
                            $student->save();
                            return redirect()->route('get-update-student-page', ['studentId' => $request->student_id]);
                        }
                        else{
                            $data["classrooms"] = Classroom::getAllClassrooms();
                            $data["students"] = Student::getAllStudents();
                            $data["error"] = "Bu username daha önce kullanıldı";
                            return view("students", compact("data"));
                        }
                    }
                    else{
                        $student->name = $request->name;
                        $student->classroom_id = $request->classroom_id;
                        $student->student_no = $request->student_no;
                        if (isset($request->control)){
                            if ($request->control){
                                $student->student_image = null;
                            }
                        }
                        $student->save();
                        return redirect()->route('get-update-student-page', ['studentId' => $request->student_id]);
                    }
                }
                else {
                    return  view("index"); // giriş yapılmadıysa login ekranına yollanır
                }
            }
            return  view("index"); // Daha önce hiç login yapılmamışsa tarayıcı açıldığından beri direkt login sayfasına yönlendir
        }
        else{
            return redirect()->route('get-our-student-page');
        }
    }

    public function deleteStudent($studentId){
        if (session()->has('login_control')) {
            if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                Student::deleteStudentInId($studentId);
                ParentStudent::deleteRowsByStudentId($studentId);
                $data["classrooms"] = Classroom::getAllClassrooms();
                $data["students"] = Student::getAllStudents();
                return view("students", compact("data"));
            }
            else {
                return  view("index"); // giriş yapılmadıysa login ekranına yollanır
            }
        }
        return  view("index"); // Daha önce hiç login yapılmamışsa tarayıcı açıldığından beri direkt login sayfasına yönlendir
    }
}