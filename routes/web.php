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

//Login
Route::get('/index', 'App\Http\Controllers\LoginController@goToLoginPage')->name('login-page');
Route::any('index/begin', 'App\Http\Controllers\LoginController@controlForLogin')->name('home-page');

//Listeleme
 Route::get('/ourTeachers', 'App\Http\Controllers\TeacherController@readTeachersFromDB')->name('get-our-teacher-page');
 Route::get('/ourStudents', 'App\Http\Controllers\StudentController@readStudentsFromDB')->name('get-our-student-page');
 Route::get('/ourParents', 'App\Http\Controllers\ParentsController@readParentsFromDB')->name('get-our-parent-page');
 Route::get('/ourCourses', 'App\Http\Controllers\CourseController@readCoursesFromDB')->name('get-our-course-page');
 Route::get('/ourClassrooms', 'App\Http\Controllers\ClassroomController@readClassroomsFromDB')->name('get-our-classroom-page');
 
//Yeni ekleme
 Route::any('/ourTeachers/add', 'App\Http\Controllers\TeacherController@addNewTeacherToDB')->name('get-add-new-teacher');
 Route::any('/ourStudents/add', 'App\Http\Controllers\StudentController@addNewStudentToDB')->name('get-add-new-student');
 Route::any('/ourParents/add', 'App\Http\Controllers\ParentsController@addNewParentToDB')->name('get-add-new-parent');
 Route::any('/ourCourses/add', 'App\Http\Controllers\CourseController@addNewCourseToDB')->name('get-add-new-course');

 //Güncelleme sayfası açma
 Route::get('/ourTeachers/update/{teacherId}', 'App\Http\Controllers\TeacherController@InformationsToOpenUpdatePage')->name('get-update-teacher-page');
 Route::get('/ourStudents/update/{studentId}', 'App\Http\Controllers\StudentController@InformationsToOpenUpdatePage')->name('get-update-student-page');
 Route::get('/ourParents/update/{parentId}', 'App\Http\Controllers\ParentsController@InformationsToOpenUpdatePage')->name('get-update-parent-page');
 Route::get('/ourCourses/update/{courseId}', 'App\Http\Controllers\CourseController@InformationsToOpenUpdatePage')->name('get-update-course-page');


 //Güncelleme
 Route::any('/ourTeachers/updateTeacher', 'App\Http\Controllers\TeacherController@updateTeacher')->name('get-update-teacher');
 Route::any('/ourStudents/updateStudent', 'App\Http\Controllers\StudentController@updateStudent')->name('get-update-student');
 Route::any('/ourParents/updateParent', 'App\Http\Controllers\ParentsController@updateParent')->name('get-update-parent');
 Route::any('/ourCourses/updateCourse', 'App\Http\Controllers\CourseController@updateCourse')->name('get-update-course');


 //sil
Route::get('/ourTeachers/deleteTeacher/{teacherId}', 'App\Http\Controllers\TeacherController@deleteteTeacher')->name('get-delete-teacher');
Route::get('/ourStudents/deleteStudent/{studentId}', 'App\Http\Controllers\StudentController@deleteStudent')->name('get-delete-student');
Route::get('/ourParents/deleteParent/{parentId}', 'App\Http\Controllers\ParentsController@deleteParent')->name('get-delete-parent');
Route::get('/ourCourses/deleteCourse/{courseId}', 'App\Http\Controllers\CourseController@deleteCourse')->name('get-delete-course');