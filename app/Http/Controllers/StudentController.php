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
                        $student->save();
                        return redirect()->route('get-update-student-page');
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