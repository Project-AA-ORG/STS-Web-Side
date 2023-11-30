<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $table = 'teacher';
    protected $primaryKey = 'teacher_id';

    public static function getAllTeachers(){
        return teacher::all();
    }

    public function classrooms() {
        return $this->belongsToMany(Classroom::class, 'teacher_classroom', 'teacher_id', 'classroom_id');
    }

    public function course() {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public static function getTeacher($teacherId){
        return teacher::where("teacher_id", $teacherId)->first();
    }

    public static function getClassroomsWithTeacher($teacherId){
        return teacher::with(['classrooms', 'course'])->where("teacher_id", $teacherId)->first();
    }

    public static function searchUserName($username){
        return teacher::where('username', $username)->exists();
    }

    public static function getLastElement(){
        return teacher::latest()->first();
    }

    public static function deleteTeacherInId($teacherId){
        Teacher::where("teacher_id", $teacherId)->delete();
    }
}