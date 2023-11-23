<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function goToLoginPage() {
        if (session()->has('login_control')) {
            if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                return  view("begin"); // giriş yapılmışsa anasayfaya yollar
            } else {
                return  view("index"); // giriş yapılmadıysa login ekranına yollanır
            }
        }
        return  view("index");
    }

    // Kullanıcı doğru giriş yapmış mı yapmamış mı kontrolü yapılır.
    public function controlForLogin(Request $request){
        if ($request->isMethod('post')) { // gelen istek post mu diye kontrol ediyorum çünkü web.php sayfasında tipini any olarak belirledim.
            $adminInfo = Admin::getAllAdmins();
            if ($adminInfo[0]->username == $request->username){
                if($adminInfo[0]->password == $request->password){
                    session(['login_control' => 1]); // login_control adında bir session tutuyorum ve kullanıcı giriş yapmış mı diye diğer tüm fonksiyonlarda kontrol yapacağım.
                    return view("begin"); //login girişi başarılı olduğundan anasayfaya gönder.
                }
            }
            $data["error_message"] = "Kullanıcı adı veya şifre hatalı";
            return view("index", compact("data"));
        }
        else{
            if (session()->has('login_control')) {
                if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                    return view("begin"); //login girişi başarılı olduğundan anasayfaya gönder.
                }
            }
        }
        //dd($adminInfo);
    }
}
