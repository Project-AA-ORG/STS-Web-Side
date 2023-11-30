<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherClassroom extends Model
{
    use HasFactory;
    protected $table = 'teacher_classroom';
    protected $primaryKey = 'teacher_classroom_id';

    public static function getAllTeacherClassrooms(){
        return TeacherClassroom::all();
    }

    public static function deleteRowsByTeacherId($teacherId){ // teacherId ile teacher_id si eşleşen satırları databaseden sildim
        TeacherClassroom::where("teacher_id", $teacherId)->delete();
    }
}