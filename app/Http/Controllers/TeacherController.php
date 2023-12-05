<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\TeacherClassroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class TeacherController extends Controller
{
    public function addNewTeacherToDB(Request $request) { //databasedeki teacher table ına yeni eleman ekler.
        if ($request->isMethod('post')) {
            if (session()->has('login_control')) {
                if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                    $teacher = new Teacher();
                    $teacher->name = $request->name;    
                    $password = $request->username . "123"; // otomatik şifre ayarladım.
                    $teacher->password = $password;
                    $teacher->username = $request->username;
                    $teacher->phone = $request->phone;
                    $teacher->course_id = $request->course_id;

                    if (!(Teacher::searchUserName($request->username))) { // daha önce bu username kullanılmış mı kullanılmamış mı diye kontrol ettim.
                        $teacher->save();
                        $teacher = Teacher::getLastElement();
                        if (is_iterable($request->classroom_id)){
                            foreach($request->classroom_id as $classroom_id){ // teacher_classroom table ına yeni öğretmen ve sınıf ekledim
                                $teacher_classroom = new TeacherClassroom();
                                $teacher_classroom->teacher_id = $teacher->teacher_id;
                                $teacher_classroom->classroom_id = $classroom_id;
                                $teacher_classroom->save();
                            }
                        }
                        else{
                            $teacher_classroom = new TeacherClassroom();
                            $teacher_classroom->teacher_id = $teacher->teacher_id;
                            $teacher_classroom->classroom_id = $request->classroom_id;
                            $teacher_classroom->save();
                        }
                    }
                    else{
                        $data["teachers"] = Teacher::getAllTeachers();
                        $data["classroom"] = Classroom::getAllClassrooms();
                        $data["course"] = Course::getAllCourses();
                        $data["error"] = "Bu username daha önce kullanıldı";
                        return view("ogretmenlerimiz", compact("data"));
                    }
                    return redirect()->route('get-our-teacher-page');
                }
                else {
                    return  view("index"); // giriş yapılmadıysa login ekranına yollanır
                }
            }
            return  view("index"); // Daha önce hiç login yapılmamışsa tarayıcı açıldığından beri direkt login sayfasına yönlendir
        }
        else{
            return redirect()->route('get-our-teacher-page');
        }
    }

    //Öğretmenleri liste halinde blade e yollama fonksiyonu
    public function readTeachersFromDB(){
        if (session()->has('login_control')) {
            if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                $data["classroom"] = Classroom::getAllClassrooms();
                $data["course"] = Course::getAllCourses();
                $data["teachers"] = Teacher::getAllTeachers();
                //dd($data);
                return view("ogretmenlerimiz", compact("data")); // !!!buraya yazılmış olan blade in adı girilecek şuan öylesine koydum
            } else {
                return  view("index"); // giriş yapılmadıysa login ekranına yollanır
            }
        }
        return  view("index"); // Daha önce hiç login yapılmamışsa tarayıcı açıldığından beri direkt login sayfasına yönlendir
    }

    // id si verilmiş olan öğretmenin girdiği sınıflar ve verdiği ders dahil tüm bilgilerini ekranda gösterir.
    public function InformationsToOpenUpdatePage($teacherId){
        //$teacherId = 10; // Örnek olarak bir öğretmen ID'si
        if (session()->has('login_control')) {
            if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                $data["teacher"] = Teacher::getClassroomsWithTeacher($teacherId);
                $data["classroom"] = Teacher::classroomsDoNotEnterThisTeacher($teacherId);
                $data["courses"] = Course::getAllCourses();
                return view("ogretmen_duzenle", compact("data")); // !!!buraya yazılmış olan blade in adı girilecek şuan öylesine koydum
            } else {
                return  view("index"); // giriş yapılmadıysa login ekranına yollanır
            }
        }
        return  view("index");
    }

    // Id si verilen öğretmeni güncelleyen fonksiyon
    public function updateTeacher(Request $request){
        if ($request->isMethod('post')) {
            if (session()->has('login_control')) {
                if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                    $teacher = Teacher::getTeacher($request->teacher_id);
                    
                    if ($teacher->username != $request->username){ //Eğer güncelleme yaparken username değiştirilmişse
                        if (!(Teacher::searchUserName($request->username))) { // daha önce bu username kullanılmış mı kullanılmamış mı diye kontrol ettim.
                            TeacherClassroom::deleteRowsByTeacherId($request->teacher_id);

                            $teacher->name = $request->name;    
                            $teacher->username = $request->username;
                            $teacher->phone = $request->phone;
                            $teacher->course_id = $request->course_id;
                            $teacher->save();
                            
                            if (isset($request->classroom_id)){
                                if (is_iterable($request->classroom_id)){
                                    foreach($request->classroom_id as $classroom_id){ // teacher_classroom table ına yeni öğretmen ve sınıf ekledim
                                        $teacher_classroom = new TeacherClassroom();
                                        $teacher_classroom->teacher_id = $teacher->teacher_id;
                                        $teacher_classroom->classroom_id = $classroom_id;
                                        $teacher_classroom->save();
                                    }
                                }
                                else{
                                    $teacher_classroom = new TeacherClassroom();
                                    $teacher_classroom->teacher_id = $teacher->teacher_id;
                                    $teacher_classroom->classroom_id = $request->classroom_id;
                                    $teacher_classroom->save();
                                }
                            }
                            return redirect()->route('get-our-teacher-page');
                        }
                        else{
                            $data["teachers"] = Teacher::getAllTeachers();
                            $data["classroom"] = Classroom::getAllClassrooms();
                            $data["course"] = Course::getAllCourses();
                            $data["error"] = "Bu username daha önce kullanıldı";
                            return view("ogretmenlerimiz", compact("data"));
                        }
                    }
                    else{//Eğer güncelleme yaparken username değiştirilmemişse
                        TeacherClassroom::deleteRowsByTeacherId($request->teacher_id);

                        $teacher->name = $request->name;    
                        $teacher->phone = $request->phone;
                        $teacher->course_id = $request->course_id;
                        $teacher->save();

                        if (isset($request->classroom_id)){
                            if (is_iterable($request->classroom_id)){
                                foreach($request->classroom_id as $classroom_id){ // teacher_classroom table ına yeni öğretmen ve sınıf ekledim
                                    $teacher_classroom = new TeacherClassroom();
                                    $teacher_classroom->teacher_id = $teacher->teacher_id;
                                    $teacher_classroom->classroom_id = $classroom_id;
                                    $teacher_classroom->save();
                                }
                            } else{
                                $teacher_classroom = new TeacherClassroom();
                                $teacher_classroom->teacher_id = $teacher->teacher_id;
                                $teacher_classroom->classroom_id = $request->classroom_id;
                                $teacher_classroom->save();
                            }
                        }
                        return redirect()->route('get-our-teacher-page');
                    }
                }
                else {
                        return  view("index"); // giriş yapılmadıysa login ekranına yollanır
                }
            }
            return  view("index"); // Daha önce hiç login yapılmamışsa tarayıcı açıldığından beri direkt login sayfasına yönlendir
        }
        else{
            return redirect()->route('get-our-teacher-page');
        }
    }

    //silme işlemi çin örnek fonksiyon
    public function deleteteTeacher($teacherId){
        if (session()->has('login_control')) {
            if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                TeacherClassroom::deleteRowsByTeacherId($teacherId);
                Teacher::deleteTeacherInId($teacherId);
                $data["teachers"] = Teacher::getAllTeachers();
                $data["classroom"] = Classroom::getAllClassrooms();
                $data["course"] = Course::getAllCourses();
                return view("ogretmenlerimiz", compact("data")); // !!!buraya yazılmış olan blade in adı girilecek şuan öylesine koydum
            }
            else {
                return  view("index"); // giriş yapılmadıysa login ekranına yollanır
            }
        }
        return  view("index"); // Daha önce hiç login yapılmamışsa tarayıcı açıldığından beri direkt login sayfasına yönlendir
    }
}

/*
Projenizdeki resimleri veritabanında tutmadan kullanmak için, genellikle Laravel'de public dizini içindeki storage dizinini kullanarak resimleri saklarsınız. Bu şekilde, resimlere public olarak erişilebilir ve herhangi bir HTTP sunucusu tarafından doğrudan servis edilebilir. İşte bu yöntemi kullanarak resim eklemenin basit bir örneği:

Resmi Public Dizinine Yükleyin:

İlk olarak, resimleri public dizini içindeki storage dizinine yükleyelim. Bu dizin genellikle projenizin ana dizininde yer alır. Terminal veya komut istemcisinde şu komutu kullanabilirsiniz:

bash
Copy code
php artisan storage:link
Bu komut, public dizini içine bir storage simgesi oluşturur ve bu sayede storage dizinindeki dosyalara public olarak erişebilirsiniz.

Resmi Yükleme ve Kaydetme:

Controller veya başka bir yerde resmi yükleyip kaydedebilirsiniz. Örneğin:

php
Copy code
public function addTeacherWithImage(Request $request)
{
    $teacher = new Teacher;
    $teacher->name = $request->input('name');
    $teacher->description = $request->input('description');

    if ($request->hasFile('image')) {
        // Resmi yükle ve storage dizinine kaydet
        $imagePath = $request->file('image')->store('teachers', 'public');

        // Resmin yolunu veritabanına kaydet
        $teacher->image = $imagePath;
    }

    $teacher->save();

    return response()->json(['message' => 'Teacher added successfully']);
}
Bu örnekte, store fonksiyonu resmi belirtilen dizine (teachers dizini) yükleyecek ve ardından resmin yolunu image sütununa kaydedecektir.

Resmi Gösterme:

Resmi göstermek için, ilgili sayfada veya view'da şu şekilde kullanabilirsiniz:

html
Copy code
<img src="{{ asset('storage/' . $teacher->image) }}" alt="Teacher Image">
asset fonksiyonu, public dizini içindeki storage dizinine yönlendirir ve belirtilen resmin yolunu döndürür. Bu yol, resmin HTTP üzerinden erişilebilen yoludur.

Bu şekilde, resimleri veritabanında saklamadan kullanabilir ve projenizin performansını artırabilirsiniz.
*/