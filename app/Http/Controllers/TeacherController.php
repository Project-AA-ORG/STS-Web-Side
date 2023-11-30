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

        if (!(Teacher::searchUserName($request->username))) { // daha önce bu username kullanılmış mı kullanılmamış mı diye kontrol ettim.
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
        if (session()->has('login_control')) {
            if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                $data["teachers"] = Teacher::getAllTeachers();
                //dd($data);
                return view("ogretmenlerimiz", compact("data")); // !!!buraya yazılmış olan blade in adı girilecek şuan öylesine koydum
            } else {
                return  view("index"); // giriş yapılmadıysa login ekranına yollanır
            }
        }
        return  view("index"); // Daha önce hiç login yapılmamışsa tarayıcı açıldığından beri direkt login sayfasına yönlendir
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
        $data["name"] = "fırat";
        $data["username"] = "fıratkaya";
        $data["phone"] = "12345";
        $data["course_id"] = 3;
        $data["classroom_id"][0] = 1;
        $data["classroom_id"][1] = 2;

        TeacherController::deneme($data);
    }

    // id si verilmiş olan öğretmenin girdiği sınıflar ve verdiği ders dahil tüm bilgilerini ekranda gösterir.
    public function example(){
        $teacherId = 10; // Örnek olarak bir öğretmen ID'si
        $teacher = Teacher::getClassroomsWithTeacher($teacherId);
        dd($teacher->course);
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