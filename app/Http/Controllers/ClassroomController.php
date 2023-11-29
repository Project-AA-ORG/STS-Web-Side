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
