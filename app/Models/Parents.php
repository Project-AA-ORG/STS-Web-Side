<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    use HasFactory;
    protected $table = 'parent';
    protected $primaryKey = 'parent_id';

    public static function getAllParents(){
        return Parents::orderBy('name')->get();
    }

    public function students() {
        return $this->belongsToMany(Student::class, 'parent_student', 'parent_id', 'student_id');
    }

    public static function studentsDoNotHaveThisParent($parentId){
        $parent = Parents::where("parent_id", $parentId)->first();
        $parentStudent = $parent->students->pluck('student_id')->toArray();
        return Student::whereNotIn('student_id', $parentStudent)->get();
    }

    public static function getStudentsByParentId($parentId){
        $parent = Parents::where("parent_id", $parentId)->first();
        if ($parent) {
            return $parent->students;
        }
        return null;
    }

    public static function getParentWithStudent($parentId){
        return Parents::with('students')->where("parent_id", $parentId)->first();
    }

    public static function getParentsWithStudents(){
        return Parents::with('students')->get();
    }

    public static function getParentInId($parentId){
        return Parents::where("parent_id", $parentId)->first();
    }

    public static function searchUserName($username){
        return Parents::where('username', $username)->exists();
    }

    public static function getLastElement(){
        return Parents::latest()->first();
    }

    public static function deleteParentInId($parentId){
        Parents::where("parent_id", $parentId)->delete();
    }
}