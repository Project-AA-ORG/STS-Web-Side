<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\TeacherClassroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class TeacherController extends Controller
{
    public function addNewTeacherToDB(Request $request) { //databasedeki teacher table ına yeni eleman ekler.
        $teacher = new Teacher();
        $teacher->name = $request->name;    
        $password = $request->username . "123"; // otomatik şifre ayarladım.
        $teacher->password = $password;
        $teacher->username = $request->username;
        $teacher->phone = $request->phone;
        $teacher->course_id = $request->course_id;

        if (!(Teacher::searchUserName($request["username"]))) { // daha önce bu username kullanılmış mı kullanılmamış mı diye kontrol ettim.
            $teacher->save();
            $teacher = Teacher::getLastElement();
            foreach($request->classroom_id as $classroom_id){ // teacher_classroom table ına yeni öğretmen ve sınıf ekledim
                $teacher_classroom = new TeacherClassroom();
                $teacher_classroom->teacher_id = $teacher->teacher_id;
                $teacher_classroom->classroom_id = $classroom_id;
                $teacher_classroom->save();
            }
        }
        else{
            // burada tekrar aynı ekleme sayfasına return yapıp o sayfada hata bastırtmalıyız. Bu username daha önce kullanıldı şeklinde
        }
    }

    //Öğretmenleri liste halinde blade e yollama fonksiyonu
    public function readTeachersFromDB(){
        $data["teachers"] = Teacher::getAllTeachers();
        //dd($data);
        return view("ogretmenlerimiz", compact("data")); // !!!buraya yazılmış olan blade in adı girilecek şuan öylesine koydum
    }

    public function deneme($request) { //databasedeki teacher table ına yeni eleman ekler.
        $teacher = new Teacher();
        $teacher->name = $request["name"];    
        $password = $request["username"] . "123"; // otomatik şifre ayarladım.
        $teacher->password = $password;
        $teacher->username = $request["username"];
        $teacher->phone = $request["phone"];
        $teacher->course_id = $request["course_id"];

        if (!(Teacher::searchUserName($request["username"]))) { // daha önce bu username kullanılmış mı kullanılmamış mı diye kontrol ettim.
            $teacher->save();
            $teacher = Teacher::getLastElement();
            foreach($request["classroom_id"] as $classroom_id){ // teacher_classroom table ına yeni öğretmen ve sınıf ekledim
                $teacher_classroom = new TeacherClassroom();
                $teacher_classroom->teacher_id = $teacher->teacher_id;
                $teacher_classroom->classroom_id = $classroom_id;
                $teacher_classroom->save();
            }
        }
    }

    public function deneme2() { //databasedeki teacher table ına yeni eleman ekler.
        $data["name"] = "talha";
        $data["username"] = "talhakaya";
        $data["phone"] = "12345";
        $data["course_id"] = 2;
        $data["classroom_id"][0] = 4;

        TeacherController::deneme($data);
    }

    // id si verilmiş olan öğretmenin girdiği sınıflar ve verdiği ders dahil tüm bilgilerini ekranda gösterir.
    public function example(){
        $teacherId = 10; // Örnek olarak bir öğretmen ID'si
        $teacher = Teacher::getClassroomsWithTeacher($teacherId);
        dd($teacher->course);
    }
}
