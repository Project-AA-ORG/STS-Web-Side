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

}