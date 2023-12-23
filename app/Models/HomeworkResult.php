<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeworkResult extends Model
{
    use HasFactory;
    protected $table = 'homework-result';
    protected $primaryKey = 'homework_result_id';

    public static function getAllHomeworkResults(){
        return HomeworkResult::all();
    }
    
    public function student(){
        return $this->belongsTo(Student::class, 'student_id', 'student_id')->with('classroom');
    }

    public static function getHomeworkResultInId($homework_result_id){
        return HomeworkResult::where('homework_result_id', $homework_result_id)->first();
    }

    public static function getHomeworkResult($homeworkId, $studentId) {
        return HomeworkResult::where('homework_id', $homeworkId)->where('student_id', $studentId)->first();
    }
}