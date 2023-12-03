<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', 'App\Http\Controllers\LoginController@goToLoginPage')->name('login-page');
Route::any('index/begin', 'App\Http\Controllers\LoginController@controlForLogin')->name('home-page');


 Route::get('/ourTeachers', 'App\Http\Controllers\TeacherController@readTeachersFromDB')->name('get-our-teacher-page');
 Route::get('/ourStudents', 'App\Http\Controllers\StudentController@readStudentsFromDB')->name('get-our-student-page');
 Route::get('/ourParents', 'App\Http\Controllers\ParentsController@readParentsFromDB')->name('get-our-parent-page');
 Route::get('/ourCourses', 'App\Http\Controllers\ClassroomController@readCoursesFromDB')->name('get-our-course-page');
 Route::get('/ourClassrooms', 'App\Http\Controllers\CourseController@readClassroomsFromDB')->name('get-our-classroom-page');


 Route::any('/ourTeachers/add', 'App\Http\Controllers\TeacherController@addNewTeacherToDB')->name('get-add-new-teacher');