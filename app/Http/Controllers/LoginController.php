<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function goToLoginPage() {
        return  view("login");
    }

    // Kullanıcı doğru giriş yapmış mı yapmamış mı kontrolü yapılır.
    public function controlForLogin(Request $request){
        $adminInfo = Admin::getAllAdmins();
        if ($adminInfo[0]->username == $request->username){
            if($adminInfo[0]->password == $request->password){
                session(['login_control' => 1]); // login_control adında bir session tutuyorum ve kullanıcı giriş yapmış mı diye diğer tüm fonksiyonlarda kontrol yapacağım.
                return view("deneme");
            }
        }
        $data["error_message"] = "Bu kullanıcı adı ve şifreye uygun admin bulunamadı";
        return view("login", compact("data"));
        //dd($adminInfo);
    }
}
