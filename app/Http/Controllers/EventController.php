<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class EventController extends Controller
{
    public function addNewEventToDB(Request $request) { //databasedeki student table ına yeni eleman ekler.
        if ($request->isMethod('post')) {
            if (session()->has('login_control')) {
                if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                    $event = new Event();
                    $event->event_title = $request->event_title;
                    $event->event_content = $request->event_content;
                    if ($request->hasFile('event_image')) {
                        $image = $request->file('event_image');
                        $filename = Str::random(40) . '.' . $image->getClientOriginalExtension();
                        $path = $image->storeAs('event_images', $filename, 'public');
                        $event->event_image = $path;
                    }
                    $event->save();
                    return redirect()->route('get-our-event-page');
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

    public function readEventsFromDB(){
        if (session()->has('login_control')) {
            if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                $data["event"] = Event::getAllEvent();
                return view("events", compact("data")); // !!!buraya yazılmış olan blade in adı girilecek şuan öylesine koydum
            } else {
                return  view("index"); // giriş yapılmadıysa login ekranına yollanır
            }
        }
        return  view("index"); // Daha önce hiç login yapılmamışsa tarayıcı açıldığından beri direkt login sayfasına yönlendir
    }

    public function InformationsToOpenUpdatePage($eventId){
        if (session()->has('login_control')) {
            if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                $data["event"] = Event::getEventInId($eventId);
                $imagePath = $data["event"]->event_image;
                if ($imagePath){
                    $data["event"]->event_image = base64_encode(File::get(storage_path("app/public/{$imagePath}")));
                }
                return view("eventEdit", compact("data")); // !!!buraya yazılmış olan blade in adı girilecek şuan öylesine koydum
            } else {
                return  view("index"); // giriş yapılmadıysa login ekranına yollanır
            }
        }
        return  view("index");
    }
    public function updateEvent(Request $request){
        if ($request->isMethod('post')) {
            if (session()->has('login_control')) {
                if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                    $event = Event::getEventInId($request->event_id);
                    $event->event_title = $request->event_title;
                    $event->event_content = $request->event_content;
                    if ($request->hasFile('event_image')) {
                        $image = $request->file('event_image');
                        $filename = Str::random(40) . '.' . $image->getClientOriginalExtension();
                        $path = $image->storeAs('event_images', $filename, 'public');
                        $event->event_image = $path;
                    }
                    $event->save();
                    return redirect()->route('get-update-event-page', ['eventId' => $request->event_id]);
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

    public function deleteEvent($eventId){
        if (session()->has('login_control')) {
            if (session('login_control') == 1) { // daha önce login girişi yapıldı mı kontrolü yapar
                Event::deleteEvent($eventId);
                return redirect()->route('get-our-event-page');
            } else {
                return  view("index"); // giriş yapılmadıysa login ekranına yollanır
            }
        }
        return  view("index");
    }
}