<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ClassroomController extends Controller
{
    // Sınıfın harfi küçükse büyültülüp database o şekilde yazılmalı.
    public function addNewClassroomToDB(Request $request) { //databasedeki classroom table ına yeni eleman ekler.
        $classroom = new Classroom();   
        $classroom->classroom_name = $request->classroom_name;
        $classroom->save();
    }

    public function readClassroomsFromDB(){
        if (session()->has('login_control')) {
            if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                $data["classrooms"] = Classroom::getAllClassrooms();
                dd($data);
                //return view("index", compact("data")); // !!!buraya yazılmış olan blade in adı girilecek şuan öylesine koydum
            } else {
                return  view("index"); // giriş yapılmadıysa login ekranına yollanır
            }
        }
        return  view("index"); // Daha önce hiç login yapılmamışsa tarayıcı açıldığından beri direkt login sayfasına yönlendir
    }

    public function updateClassroom(Request $request){
        $classroom = Classroom::getClassroomInId($request->classroom_id);
        $classroom->classroom_name = $request->classroom_name;
        $classroom->save();
    }

    public function deneme($request) { //databasedeki classroom table ına yeni eleman ekler.
        $classroom = new Classroom();

        $classroom->classroom_name = $request["classroom_name"];

        $classroom->save();
    }

    public function deneme2() { //databasedeki classroom table ına yeni eleman ekler.
        $data["classroom_name"] = "8A";

        ClassroomController::deneme($data);
    }
}
