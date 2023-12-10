<?php

namespace App\Http\Controllers;

use App\Models\Parents;
use App\Models\ParentStudent;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ParentsController extends Controller
{
    public function addNewParentToDB(Request $request) { //databasedeki Parent table ına yeni eleman ekler.
        if ($request->isMethod('post')) {
            if (session()->has('login_control')) {
                if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                    $parents = new Parents();
                    $parents->name = $request->name;    
                    $password = $request->username . "123"; // otomatik şifre ayarladım.
                    $parents->password = $password;
                    $parents->username = $request->username;
                    $parents->phone = $request->phone;

                    if (!(Parents::searchUserName($request->username))) { // daha önce bu username kullanılmış mı kullanılmamış mı diye kontrol ettim.
                        $parents->save();
                        $parents = Parents::getLastElement();
                        if (is_iterable($request->student_id)){
                            foreach($request->student_id as $student_id){ // parent_student table ına yeni veli ve öğrenci ekledim
                                $parent_student = new ParentStudent();
                                $parent_student->parent_id = $parents->parent_id;
                                $parent_student->student_id = $student_id;
                                $parent_student->save();
                            }
                        }
                        else{
                            $parent_student = new ParentStudent();
                            $parent_student->parent_id = $parents->parent_id;
                            $parent_student->student_id = $request->student_id;
                            $parent_student->save();
                        }
                        return redirect()->route('get-our-parent-page');
                    }
                    else{
                        $data["students"] = Student::getAllStudents();
                        $data["parents"] = Parents::getAllParents();
                        $data["error"] = "Bu username daha önce kullanıldı";
                        return view("parents", compact("data")); // !!!buraya yazılmış olan blade in adı girilecek şuan öylesine koydum
                    }
                }
                else {
                    return  view("index"); // giriş yapılmadıysa login ekranına yollanır
                }
            }
            return  view("index"); // Daha önce hiç login yapılmamışsa tarayıcı açıldığından beri direkt login sayfasına yönlendir
        }
        else{
            return redirect()->route('get-our-parent-page');
        }
    }

    //Öğretmenleri liste halinde blade e yollama fonksiyonu
    public function readParentsFromDB(){
        if (session()->has('login_control')) {
            if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                $data["students"] = Student::getAllStudents();
                $data["parents"] = Parents::getAllParents();
                return view("parents", compact("data")); // !!!buraya yazılmış olan blade in adı girilecek şuan öylesine koydum
            } else {
                return  view("index"); // giriş yapılmadıysa login ekranına yollanır
            }
        }
        return  view("index"); // Daha önce hiç login yapılmamışsa tarayıcı açıldığından beri direkt login sayfasına yönlendir
    }

    public function InformationsToOpenUpdatePage($parentId){
        if (session()->has('login_control')) {
            if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                $data["parent"] = Parents::getParentWithStudent($parentId);
                $data["students"] = Parents::studentsDoNotHaveThisParent($parentId);
                return view("parentEdit", compact("data")); // !!!buraya yazılmış olan blade in adı girilecek şuan öylesine koydum
            } else {
                return  view("index"); // giriş yapılmadıysa login ekranına yollanır
            }
        }
        return  view("index");
    }

    public function updateParent(Request $request){
        if ($request->isMethod('post')) {
            if (session()->has('login_control')) {
                if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                    $parents = Parents::getParentInId($request->parent_id);

                    if ($parents->username != $request->username){ //Eğer güncelleme yaparken username değiştirilmişse
                        if (!(Parents::searchUserName($request->username))) { // daha önce bu username kullanılmış mı kullanılmamış mı diye kontrol ettim.
                            ParentStudent::deleteRowsByParentId($request->parent_id);

                            $parents->name = $request->name;    
                            $parents->username = $request->username;
                            $parents->phone = $request->phone;
                            $parents->save();
                            
                            if (isset($request->student_id)){
                                if (is_iterable($request->student_id)){
                                    foreach($request->student_id as $student_id){ // parent_student table ına yeni veli ve öğrenci ekledim
                                        $parent_student = new ParentStudent();
                                        $parent_student->parent_id = $parents->parent_id;
                                        $parent_student->student_id = $student_id;
                                        $parent_student->save();
                                    }
                                }
                                else{
                                    $parent_student = new ParentStudent();
                                    $parent_student->parent_id = $parents->parent_id;
                                    $parent_student->student_id = $request->student_id;
                                    $parent_student->save();
                                }
                            }
                            return redirect()->route('get-our-parent-page');
                        }
                        else{
                            $data["students"] = Student::getAllStudents();
                            $data["parents"] = Parents::getAllParents();
                            $data["error"] = "Bu username daha önce kullanıldı";
                            return view("parents", compact("data")); // !!!buraya yazılmış olan blade in adı girilecek şuan öylesine koydum
                        }
                    }
                    else{
                        ParentStudent::deleteRowsByParentId($request->parent_id);

                        $parents->name = $request->name;    
                        $parents->phone = $request->phone;
                        $parents->save();
                        if (isset($request->student_id)){
                            if (is_iterable($request->student_id)){
                                foreach($request->student_id as $student_id){ // parent_student table ına yeni veli ve öğrenci ekledim
                                    $parent_student = new ParentStudent();
                                    $parent_student->parent_id = $parents->parent_id;
                                    $parent_student->student_id = $student_id;
                                    $parent_student->save();
                                }
                            }
                            else{
                                $parent_student = new ParentStudent();
                                $parent_student->parent_id = $parents->parent_id;
                                $parent_student->student_id = $request->student_id;
                                $parent_student->save();
                            }
                        }
                        return redirect()->route('get-our-parent-page');
                    }
                }
                else {
                        return  view("index"); // giriş yapılmadıysa login ekranına yollanır
                }
            }
            return  view("index"); // Daha önce hiç login yapılmamışsa tarayıcı açıldığından beri direkt login sayfasına yönlendir
        }
        else{
            return redirect()->route('get-our-parent-page');
        }
    }

    public function deleteParent($parentId){
        if (session()->has('login_control')) {
            if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                Parents::deleteParentInId($parentId);
                ParentStudent::deleteRowsByParentId($parentId);

                $data["students"] = Student::getAllStudents();
                $data["parents"] = Parents::getAllParents();
                return view("parents", compact("data")); // !!!buraya yazılmış olan blade in adı girilecek şuan öylesine koydum
            }
            else {
                return  view("index"); // giriş yapılmadıysa login ekranına yollanır
            }
        }
        return  view("index"); // Daha önce hiç login yapılmamışsa tarayıcı açıldığından beri direkt login sayfasına yönlendir
    }
}