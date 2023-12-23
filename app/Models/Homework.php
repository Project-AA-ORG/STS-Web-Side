<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    use HasFactory;
    protected $table = 'homework';
    protected $primaryKey = 'homework_id';

    public static function getAllHomeworks(){
        return homework::all();
    }

    public function results(){
        return $this->hasMany(HomeworkResult::class, 'homework_id');
    }
    
    public function teacher(){
        return $this->belongsTo(Teacher::class, 'teacher_id', 'teacher_id')->with('classrooms', 'course');
    }

    public static function getHomeworkInHomeworkId($homeworkId){
        return Homework::where("homework_id", $homeworkId)->first();
    }

    public static function getHomeworksInClassroomId($classroomId){
        return Homework::where("classroom_id", $classroomId)->get();
    }

    public static function getHomeworksWithResultsInId($classroomId){
        return Homework::where("classroom_id", $classroomId)->with('results')->with('teacher')->get();
    }

    public static function getHomeworksWithResults(){
        return Homework::with('results')->get();
    }

    public static function getHomeworkWithResultsInId($studentId, $classroomId){
        $assignments = Homework::where('classroom_id', $classroomId)->with('teacher')->get();
        if ($studentId !== null) {
            $assignments->load(['results' => function ($query) use ($studentId) {
                $query->where('student_id', $studentId);
            }]);
        }
        return $assignments;
    }

    public static function getHomeworkInId($homeworkId){
        return homework::where("homework_id", $homeworkId)->first();
    }

    public static function deleteHomeworkInId($homeworkId){
        homework::where("homework_id", $homeworkId)->delete();
        HomeworkResult::where('homework_id', $homeworkId)->delete();
    } 
}