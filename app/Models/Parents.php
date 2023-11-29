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
        return Parents::all();
    }

    public function students() {
        return $this->belongsToMany(Student::class, 'parent_student', 'parent_id', 'student_id');
    }

    public static function getStudentsWithParent($parentId){
        return Parents::with('students')->where("parent_id", $parentId)->first();
    }

    public static function searchUserName($username){
        return Parents::where('username', $username)->exists();
    }

    public static function getLastElement(){
        return Parents::latest()->first();
    }
}