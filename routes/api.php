<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Login girişinin kontrolü için route
Route::post('/v1/login', [AuthController::class, 'login']);
//bir velinin öğrencilerini listelemek için route
Route::get('/v1/parent/students/{id}', [AuthController::class, 'studentsOfParent']);
//ödevi database e eklemek için route
Route::post('/v1/homework/add', [AuthController::class, 'saveHomeworkToDB']);
//classroom announcement ı database e eklemek için route
Route::post('/v1/announcement/add', [AuthController::class, 'saveAnnouncementToDB']);
//classroom announcement ve homeworks ü yollamak için route
Route::get('/v1/homeworks/announcements/{classroomId}/{studentId}', [AuthController::class, 'giveInformationAboutClass']);
//teacher_id alıp o öğretmenin girdiği sınıfları dönmek için route
Route::get('v1/classrooms/{teacherId}', [AuthController::class, 'classroomOfTeacher']);
//classroom_id alıp öğretmen için o sınıfın tüm ödev(sonuçlarla birlikte), duyurularını ve öğrencilerini dönmek için route
Route::get('/v1/teacher/homeworks/announcements/{classroomId}', [AuthController::class, 'giveInformationAboutClassForTeacher']);
//belirli bir öğrencinin belirli bir dersinin sonucunu return edecek fonksiyon için route
Route::get('/v1/homework/result/{homeworkId}/{studentId}', [AuthController::class, 'getHomeworkResultsInSomeId']);
//belirli bir ödevi databaseden silmek için route
Route::get('/v1/homework/{homeworkId}', [AuthController::class, 'deleteHomeworkInId']);
//belirli bir sınıf duyurusunu silmek için route
Route::get('/v1/announcements/{classroomAnnouncementId}', [AuthController::class, 'deleteClassroomAnnouncementInId']);
//ödevi güncellemek için route
Route::post('/v1/homework/update', [AuthController::class, 'updateHomework']);
//duyuruyu güncellemek için route
Route::post('/v1/announcements/update', [AuthController::class, 'updateAnnouncement']);
//ödeve puan eklemek için route
Route::post('/v1/homework/result/add', [AuthController::class, 'saveResultToDB']);
//ödev puanını güncellemek için route
Route::post('/v1/homework/result/update', [AuthController::class, 'updateResult']);
//duyuru ve etkinlikleri göndermek için route
Route::get('/v1/event/announcement', [AuthController::class, 'sendEventsAndAnnouncements']);