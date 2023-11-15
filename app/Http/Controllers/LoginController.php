<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function goToLoginPage() {
        return  view("login");
    }

    public function controlForLogin(Request $request){

        $adminInfo = Admin::getAllAdmins();
        if ($adminInfo[0]->username == $request->username){
            if($adminInfo[0]->password == $request->password){
                // $data["successful"] = 1;
                // return $data;
                return view("deneme");
            }
        }
        $data["error_message"] = "Bu kullanıcı adı ve şifreye uygun admin bulunamadı";
        return view("login", compact("data"));
        //dd($adminInfo);
    }
}
