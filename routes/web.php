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


//Login
Route::get('/', 'App\Http\Controllers\LoginController@goToLoginPage')->name('login-page');
Route::any('/begin', 'App\Http\Controllers\LoginController@controlForLogin')->name('home-page');

//Listeleme
 Route::get('/ourTeachers', 'App\Http\Controllers\TeacherController@readTeachersFromDB')->name('get-our-teacher-page');
 Route::get('/ourStudents', 'App\Http\Controllers\StudentController@readStudentsFromDB')->name('get-our-student-page');
 Route::get('/ourParents', 'App\Http\Controllers\ParentsController@readParentsFromDB')->name('get-our-parent-page');
 Route::get('/ourCourses', 'App\Http\Controllers\CourseController@readCoursesFromDB')->name('get-our-course-page');
 Route::get('/ourClassrooms', 'App\Http\Controllers\ClassroomController@readClassroomsFromDB')->name('get-our-classroom-page');
 Route::get('/ourAnnouncements', 'App\Http\Controllers\GeneralAnnouncementController@readAnnouncementsFromDB')->name('get-our-announcement-page');
 Route::get('/ourEvents', 'App\Http\Controllers\EventController@readEventsFromDB')->name('get-our-event-page');


//Yeni ekleme
 Route::any('/ourTeachers/add', 'App\Http\Controllers\TeacherController@addNewTeacherToDB')->name('get-add-new-teacher');
 Route::any('/ourStudents/add', 'App\Http\Controllers\StudentController@addNewStudentToDB')->name('get-add-new-student');
 Route::any('/ourParents/add', 'App\Http\Controllers\ParentsController@addNewParentToDB')->name('get-add-new-parent');
 Route::any('/ourCourses/add', 'App\Http\Controllers\CourseController@addNewCourseToDB')->name('get-add-new-course');
 Route::any('/ourClassrooms/add', 'App\Http\Controllers\ClassroomController@addNewClassroomToDB')->name('get-add-new-classroom');
 Route::any('/ourAnnouncements/add', 'App\Http\Controllers\GeneralAnnouncementController@addNewAnnouncementToDB')->name('get-add-new-announcement');
 Route::any('/ourEvents/add', 'App\Http\Controllers\EventController@addNewEventToDB')->name('get-add-new-event');


 //Güncelleme sayfası açma
 Route::get('/ourTeachers/update/{teacherId}', 'App\Http\Controllers\TeacherController@InformationsToOpenUpdatePage')->name('get-update-teacher-page');
 Route::get('/ourStudents/update/{studentId}', 'App\Http\Controllers\StudentController@InformationsToOpenUpdatePage')->name('get-update-student-page');
 Route::get('/ourParents/update/{parentId}', 'App\Http\Controllers\ParentsController@InformationsToOpenUpdatePage')->name('get-update-parent-page');
 Route::get('/ourCourses/update/{courseId}', 'App\Http\Controllers\CourseController@InformationsToOpenUpdatePage')->name('get-update-course-page');
 Route::get('/ourClassrooms/update/{classroomId}', 'App\Http\Controllers\ClassroomController@InformationsToOpenUpdatePage')->name('get-update-classroom-page');
 Route::get('/ourAnnouncements/update/{announcementId}', 'App\Http\Controllers\GeneralAnnouncementController@InformationsToOpenUpdatePage')->name('get-update-announcement-page');
 Route::get('/ourEvents/update/{eventId}', 'App\Http\Controllers\EventController@InformationsToOpenUpdatePage')->name('get-update-event-page');

 //Güncelleme
 Route::any('/ourTeachers/updateTeacher', 'App\Http\Controllers\TeacherController@updateTeacher')->name('get-update-teacher');
 Route::any('/ourStudents/updateStudent', 'App\Http\Controllers\StudentController@updateStudent')->name('get-update-student');
 Route::any('/ourParents/updateParent', 'App\Http\Controllers\ParentsController@updateParent')->name('get-update-parent');
 Route::any('/ourCourses/updateCourse', 'App\Http\Controllers\CourseController@updateCourse')->name('get-update-course');
 Route::any('/ourClassrooms/updateClassroom', 'App\Http\Controllers\ClassroomController@updateClassroom')->name('get-update-classroom');
 Route::any('/ourAnnouncements/updateAnnouncement', 'App\Http\Controllers\GeneralAnnouncementController@updateAnnouncement')->name('get-update-announcement');
 Route::any('/ourEvents/updateEvent', 'App\Http\Controllers\EventController@updateEvent')->name('get-update-event');

 //sil
Route::get('/ourTeachers/deleteTeacher/{teacherId}', 'App\Http\Controllers\TeacherController@deleteteTeacher')->name('get-delete-teacher');
Route::get('/ourStudents/deleteStudent/{studentId}', 'App\Http\Controllers\StudentController@deleteStudent')->name('get-delete-student');
Route::get('/ourParents/deleteParent/{parentId}', 'App\Http\Controllers\ParentsController@deleteParent')->name('get-delete-parent');
Route::get('/ourCourses/deleteCourse/{courseId}', 'App\Http\Controllers\CourseController@deleteCourse')->name('get-delete-course');
Route::get('/ourClassrooms/deleteCourse/{classroomId}', 'App\Http\Controllers\ClassroomController@deleteClassroom')->name('get-delete-classroom');
Route::get('/ourAnnouncements/deleteAnnouncement/{announcementId}', 'App\Http\Controllers\GeneralAnnouncementController@deleteAnnouncement')->name('get-delete-announcement');
Route::get('/ourEvents/deleteEvent/{eventId}', 'App\Http\Controllers\EventController@deleteEvent')->name('get-delete-event');