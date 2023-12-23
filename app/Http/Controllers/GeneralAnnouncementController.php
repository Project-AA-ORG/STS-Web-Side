<?php

namespace App\Http\Controllers;

use App\Models\GeneralAnnouncement;
use Illuminate\Http\Request;
use App\Models\Teacher;

class GeneralAnnouncementController extends Controller
{
    public function addNewAnnouncementToDB(Request $request) { //databasedeki student table ına yeni eleman ekler.
        if ($request->isMethod('post')) {
            if (session()->has('login_control')) {
                if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                    $announcement = new GeneralAnnouncement();
                    $announcement->announcement_title = $request->announcement_title;
                    $announcement->announcement_content = $request->announcement_content;
                    $announcement->save();
                    return redirect()->route('get-our-announcement-page');
                }
                else {
                    return  view("index"); // giriş yapılmadıysa login ekranına yollanır
                }
            }
            return  view("index"); // Daha önce hiç login yapılmamışsa tarayıcı açıldığından beri direkt login sayfasına yönlendir
        }
        else{
            return redirect()->route('get-our-announcement-page');
        }
    }

    public function readAnnouncementsFromDB(){
        if (session()->has('login_control')) {
            if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                $data["announcement"] = GeneralAnnouncement::getAllAnnouncement();
                return view("announcements", compact("data")); // !!!buraya yazılmış olan blade in adı girilecek şuan öylesine koydum
            } else {
                return  view("index"); // giriş yapılmadıysa login ekranına yollanır
            }
        }
        return  view("index"); // Daha önce hiç login yapılmamışsa tarayıcı açıldığından beri direkt login sayfasına yönlendir
    }

    public function InformationsToOpenUpdatePage($announcementId){
        if (session()->has('login_control')) {
            if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                $data["announcement"] = GeneralAnnouncement::getAnnouncementInId($announcementId);
                return view("announcementEdit", compact("data")); // !!!buraya yazılmış olan blade in adı girilecek şuan öylesine koydum
            } else {
                return  view("index"); // giriş yapılmadıysa login ekranına yollanır
            }
        }
        return  view("index");
    }

    public function updateAnnouncement(Request $request){
        if ($request->isMethod('post')) {
            if (session()->has('login_control')) {
                if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                    $announcement = GeneralAnnouncement::getAnnouncementInId($request->general_announcement_id);
                    $announcement->announcement_title = $request->announcement_title;
                    $announcement->announcement_content = $request->announcement_content;
                    $announcement->save();
                    return redirect()->route('get-update-announcement-page', ['announcementId' => $request->general_announcement_id]);
                }
                else {
                    return  view("index"); // giriş yapılmadıysa login ekranına yollanır
                }
            }
            return  view("index"); // Daha önce hiç login yapılmamışsa tarayıcı açıldığından beri direkt login sayfasına yönlendir
        }
        else{
            return redirect()->route('get-our-announcement-page');
        }
    }

    public function deleteAnnouncement($announcementId){
        if (session()->has('login_control')) {
            if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                GeneralAnnouncement::deleteAnnouncement($announcementId);
                return redirect()->route('get-our-announcement-page');
            } else {
                return  view("index"); // giriş yapılmadıysa login ekranına yollanır
            }
        }
        return  view("index");
    }
}
