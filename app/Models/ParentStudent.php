<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentStudent extends Model
{
    use HasFactory;
    protected $table = 'parent_student';
    protected $primaryKey = 'parent_student_id';

    public static function getAllParentStudent(){
        return ParentStudent::all();
    }

    public static function deleteRowsByStudentId($studentId){
        ParentStudent::where("student_id", $studentId)->delete();
    }

    public static function deleteRowsByParentId($parentId){
        ParentStudent::where("parent_id", $parentId)->delete();
    }
}