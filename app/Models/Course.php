<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $table = 'course';
    protected $primaryKey = 'course_id';

    public static function getAllCourses(){
        return course::orderBy('course_name')->get();
    }

    public static function getCourseInId($courseId){
        return course::where("course_id", $courseId)->first();
    }

    public static function deleteCourseInId($courseId){
        Course::where("course_id", $courseId)->delete();
    }
}