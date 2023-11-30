<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\TeacherClassroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    public function addNewStudentToDB(Request $request) { //databasedeki student table ına yeni eleman ekler.
        $student = new Student();
        $student->name = $request->name;    
        $password = $request->username . "123"; // otomatik şifre ayarladım.
        $student->password = $password;
        $student->username = $request->username;
        $student->classroom_id = $request->classroom_id;

        if (!(Student::searchUserName($request["username"]))) { // daha önce bu username kullanılmış mı kullanılmamış mı diye kontrol ettim.
            $student->save();
        }
        else{
            // burada tekrar aynı ekleme sayfasına return yapıp o sayfada hata bastırtmalıyız. Bu username daha önce kullanıldı şeklinde
        }
    }

    //Öğretmenleri liste halinde blade e yollama fonksiyonu
    public function readStudentsFromDB(){
        if (session()->has('login_control')) {
            if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                $data["students"] = Student::getAllStudents();
                dd($data);
                //return view("index", compact("data")); // !!!buraya yazılmış olan blade in adı girilecek şuan öylesine koydum
            } else {
                return  view("index"); // giriş yapılmadıysa login ekranına yollanır
            }
        }
        return  view("index"); // Daha önce hiç login yapılmamışsa tarayıcı açıldığından beri direkt login sayfasına yönlendir
    }

    public function deneme($request) { //databasedeki teacher table ına yeni eleman ekler.
        $student = new Student();
        $student->name = $request["name"];    
        $password = $request["username"] . "123"; // otomatik şifre ayarladım.
        $student->password = $password;
        $student->username = $request["username"];
        $student->classroom_id = $request["classroom_id"];

        if (!(Student::searchUserName($request["username"]))) { // daha önce bu username kullanılmış mı kullanılmamış mı diye kontrol ettim.
            $student->save();
        }
    }

    public function deneme2() { //databasedeki teacher table ına yeni eleman ekler.
        $data["name"] = "rabia";
        $data["username"] = "rabiabetül";
        $data["classroom_id"] = 2;

        StudentController::deneme($data);
    }

    public function example(){
        $studentId = 2; // Örnek olarak bir öğretmen ID'si
        $student = Student::getClassroomWithStudent($studentId);
        dd($student);
    }
}