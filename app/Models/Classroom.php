<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;
    protected $table = 'classroom';
    protected $primaryKey = 'classroom_id';

    public static function getAllClassrooms(){
        return classroom::all();
    }

    public static function getClassroomInId($classroomId){
        return classroom::where("classroom_id", $classroomId);
    }

    public static function deleteClassroomInId($classroomId){
        Classroom::where("classroom_id", $classroomId)->delete();
    }
}